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
            if ($item->product->is_out_of_stock || $item->product->stock_quantity <= 0) {
                return redirect()->route('cart')->with('error', 'Some items in your cart are currently out of stock. Please remove them to proceed.');
            }
            if ($item->product->stock_quantity < $item->quantity) {
                return redirect()->route('cart')->with('error', 'Insufficient stock for ' . $item->product->name . '. Please reduce the quantity.');
            }
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
            if ($coupon && $coupon->is_active && (!$coupon->expires_at || $coupon->expires_at > now()) && $subtotal >= $coupon->min_cart_value) {
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
        session()->put('applied_coupon_code', $coupon->code);

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
        session()->forget('applied_coupon_code');

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
            'first_name' => 'required_without:address_id|nullable|string|max:255',
            'last_name' => 'required_without:address_id|nullable|string|max:255',
            'country' => 'required_without:address_id|nullable|string|max:255',
            'address' => 'required_without:address_id|nullable|string|max:255',
            'city' => 'required_without:address_id|nullable|string|max:255',
            'state' => 'required_without:address_id|nullable|string|max:255',
            'postal_code' => 'required_without:address_id|nullable|digits:6',
            'phone' => 'required_without:address_id|nullable|digits:10',
            'email' => 'required_without:address_id|nullable|email:rfc,dns|max:255',
            'notes' => 'nullable|string',
            'payment' => 'required|string|in:cod,razorpay'
        ], [
            'postal_code.digits' => 'The pincode must be exactly 6 digits.',
            'phone.digits' => 'The mobile number must be exactly 10 digits.',
            'payment.required' => 'Please select a payment method.'
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
            $lockedProducts = [];
            foreach ($cart->items as $item) {
                $product = \App\Models\Product::where('id', $item->product_id)->lockForUpdate()->first();
                if (!$product || $product->is_out_of_stock || $product->stock_quantity < $item->quantity) {
                    throw new \Exception('Product "' . ($product ? $product->name : 'Unknown') . '" is out of stock or requested quantity is unavailable.');
                }
                $lockedProducts[$item->id] = $product;
                $subtotal += $product->price * $item->quantity;
            }

            $deliveryCharge = DeliverySetting::first()?->charge ?? 0;
            $taxRate = Tax::first()?->rate ?? 0;
            $taxAmount = ($subtotal * $taxRate) / 100;
            $couponId = session()->get('applied_coupon_id');
            $discountAmount = 0;
            $coupon = null;
            
            if ($couponId) {
                $coupon = Coupon::find($couponId);
                if ($coupon && $coupon->is_active && (!$coupon->expires_at || $coupon->expires_at > now()) && $subtotal >= $coupon->min_cart_value) {
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
                'notes' => $request->notes,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment ?? 'cod',
                'payment_status' => 'pending',
                'shipping_address' => $shippingAddress,
                'billing_address' => $shippingAddress,
            ]);

            foreach ($cart->items as $item) {
                $product = $lockedProducts[$item->id];
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $product->price,
                    'total' => $product->price * $item->quantity,
                ]);
                
                $product->stock_quantity -= $item->quantity;
                $product->save();
            }

            $cart->items()->delete();
            $cart->delete();
            session()->forget('applied_coupon_id');
            session()->forget('applied_coupon_code');

            if ($request->payment === 'razorpay') {
                $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $razorpayOrder = $api->order->create([
                    'receipt' => $order->order_number,
                    'amount' => round($order->total_amount * 100), // in paise
                    'currency' => 'INR'
                ]);
                
                $order->razorpay_order_id = $razorpayOrder['id'];
                $order->save();
                DB::commit();

                return view('frontend.pages.payment', compact('order', 'customer'));
            }

            DB::commit();

            return redirect()->route('checkout.thankyou', $order->order_number)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error placing order: ' . $e->getMessage())->withInput();
        }
    }

    public function razorpayCallback(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string'
        ]);

        $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        
        try {
            $attributes = array(
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            );
            $api->utility->verifyPaymentSignature($attributes);
            
            $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->firstOrFail();
            $order->payment_status = 'paid';
            $order->razorpay_payment_id = $request->razorpay_payment_id;
            $order->save();
            
            return redirect()->route('checkout.thankyou', $order->order_number)->with('success', 'Payment successful!');
        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            return redirect()->route('home')->with('error', 'Payment verification failed!');
        }
    }

    public function thankyou($order_number)
    {
        $order = Order::where('order_number', $order_number)->firstOrFail();
        if ($order->user_id !== Auth::guard('customer')->id()) {
            abort(403);
        }
        return view('frontend.pages.thankyou', compact('order'));
    }
}
