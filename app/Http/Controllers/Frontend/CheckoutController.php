<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DeliverySetting;
use App\Models\Tax;
use App\Models\Coupon;

class CheckoutController extends Controller
{
    private function getCart()
    {
        return Cart::where('customer_id', Auth::guard('customer')->id())
            ->orWhere('session_id', session()->getId())
            ->first();
    }

    public function index()
    {
        $cart = $this->getCart();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }

        $customer = Auth::guard('customer')->user();
        $addresses = CustomerAddress::where('customer_id', $customer->id)->get();

        $subtotal = 0;
        foreach ($cart->items as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        // Simplistic tax/delivery for display, can be expanded
        $deliveryCharge = DeliverySetting::first()?->charge ?? 0;
        $taxRate = Tax::first()?->rate ?? 0;
        $taxAmount = ($subtotal * $taxRate) / 100;
        // Check for session coupon
        $couponId = session()->get('applied_coupon_id');
        $discountAmount = 0;
        
        if ($couponId) {
            $coupon = Coupon::find($couponId);
            if ($coupon && $coupon->is_active && $coupon->expires_at > now() && $subtotal >= $coupon->min_cart_value) {
                if ($coupon->type === 'percentage') {
                    $calculatedDiscount = ($subtotal * $coupon->value) / 100;
                    $discountAmount = $coupon->max_discount ? min($calculatedDiscount, $coupon->max_discount) : $calculatedDiscount;
                } else {
                    $discountAmount = $coupon->value;
                }
            } else {
                session()->forget('applied_coupon_id'); // Invalid coupon
            }
        }

        $total = $subtotal + $taxAmount + $deliveryCharge - $discountAmount;

        return view('frontend.pages.checkout', compact('cart', 'addresses', 'subtotal', 'deliveryCharge', 'taxAmount', 'discountAmount', 'total'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        $cart = $this->getCart();
        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart is empty.']);
        }

        $subtotal = 0;
        foreach ($cart->items as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }

        if (!$coupon->is_active || ($coupon->expires_at && $coupon->expires_at < now())) {
            return response()->json(['success' => false, 'message' => 'Coupon has expired.']);
        }

        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            return response()->json(['success' => false, 'message' => 'Coupon usage limit reached.']);
        }

        if ($subtotal < $coupon->min_cart_value) {
            return response()->json(['success' => false, 'message' => 'Minimum cart value of ₹' . $coupon->min_cart_value . ' required.']);
        }

        // Apply coupon to session
        session()->put('applied_coupon_id', $coupon->id);

        $discountAmount = 0;
        if ($coupon->type === 'percentage') {
            $calculatedDiscount = ($subtotal * $coupon->value) / 100;
            $discountAmount = $coupon->max_discount ? min($calculatedDiscount, $coupon->max_discount) : $calculatedDiscount;
        } else {
            $discountAmount = $coupon->value;
        }

        $deliveryCharge = DeliverySetting::first()?->charge ?? 0;
        $taxRate = Tax::first()?->rate ?? 0;
        $taxAmount = ($subtotal * $taxRate) / 100;
        $total = $subtotal + $taxAmount + $deliveryCharge - $discountAmount;

        return response()->json([
            'success' => true, 
            'message' => 'Coupon applied successfully!',
            'discount' => round($discountAmount),
            'total' => round($total)
        ]);
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('applied_coupon_id');

        $cart = $this->getCart();
        $subtotal = 0;
        if ($cart) {
            foreach ($cart->items as $item) {
                $subtotal += $item->product->price * $item->quantity;
            }
        }

        $deliveryCharge = DeliverySetting::first()?->charge ?? 0;
        $taxRate = Tax::first()?->rate ?? 0;
        $taxAmount = ($subtotal * $taxRate) / 100;
        $total = $subtotal + $taxAmount + $deliveryCharge;

        return response()->json([
            'success' => true, 
            'message' => 'Coupon removed.',
            'discount' => 0,
            'total' => round($total)
        ]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'address_id' => 'nullable|exists:customer_addresses,id',
            'first_name' => 'required_without:address_id|string|max:255',
            'last_name' => 'required_without:address_id|string|max:255',
            'country' => 'required_without:address_id|string|max:255',
            'address' => 'required_without:address_id|string|max:255',
            'city' => 'required_without:address_id|string|max:255',
            'state' => 'required_without:address_id|string|max:255',
            'postal_code' => 'required_without:address_id|numeric',
            'phone' => 'required_without:address_id|numeric',
            'email' => 'required_without:address_id|email',
            'notes' => 'nullable|string'
        ]);

        $cart = $this->getCart();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }

        $customer = Auth::guard('customer')->user();
        
        DB::beginTransaction();
        try {
            if ($request->filled('address_id')) {
                $address = CustomerAddress::where('id', $request->address_id)->where('customer_id', $customer->id)->firstOrFail();
                $shippingAddress = $address->address . ', ' . $address->city . ', ' . $address->state . ' ' . $address->postal_code . ', ' . $address->country;
            } else {
                $shippingAddress = $request->address . ', ' . $request->city . ', ' . $request->state . ' ' . $request->postal_code . ', ' . $request->country;
                // Save new address
                CustomerAddress::create([
                    'customer_id' => $customer->id,
                    'type' => 'home',
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'postal_code' => $request->postal_code,
                ]);
            }

            $subtotal = 0;
            foreach ($cart->items as $item) {
                $subtotal += $item->product->price * $item->quantity;
            }

            $deliveryCharge = DeliverySetting::first()?->charge ?? 0;
            $taxRate = Tax::first()?->rate ?? 0;
            $taxAmount = ($subtotal * $taxRate) / 100;
            $couponId = session()->get('applied_coupon_id');
            $discountAmount = 0;
            $coupon = null;
            
            if ($couponId) {
                $coupon = Coupon::find($couponId);
                if ($coupon && $coupon->is_active && $coupon->expires_at > now() && $subtotal >= $coupon->min_cart_value) {
                    if ($coupon->type === 'percentage') {
                        $calculatedDiscount = ($subtotal * $coupon->value) / 100;
                        $discountAmount = $coupon->max_discount ? min($calculatedDiscount, $coupon->max_discount) : $calculatedDiscount;
                    } else {
                        $discountAmount = $coupon->value;
                    }
                    
                    // Increment coupon usage
                    $coupon->increment('used_count');
                }
            }

            $total = $subtotal + $taxAmount + $deliveryCharge - $discountAmount;

            $order = Order::create([
                'user_id' => $customer->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'delivery_charge' => $deliveryCharge,
                'discount_amount' => $discountAmount,
                'coupon_code' => $coupon ? $coupon->code : null,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'shipping_address' => $shippingAddress,
                'billing_address' => $shippingAddress,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'total' => $item->product->price * $item->quantity,
                ]);
            }

            $cart->items()->delete();
            $cart->delete();
            session()->forget('applied_coupon_id');

            DB::commit();

            return redirect()->route('checkout.thankyou', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error placing order: ' . $e->getMessage())->withInput();
        }
    }

    public function thankyou(Order $order)
    {
        if ($order->user_id !== Auth::guard('customer')->id()) {
            abort(403);
        }
        return view('frontend.pages.thankyou', compact('order'));
    }
}
