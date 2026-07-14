<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCart()
    {
        if (Auth::guard('customer')->check()) {
            return Cart::firstOrCreate(
                ['customer_id' => Auth::guard('customer')->id()],
                ['session_id' => session()->getId()]
            );
        }

        return Cart::firstOrCreate(
            ['session_id' => session()->getId()],
            ['customer_id' => null]
        );
    }

    public function getCount()
    {
        $cart = $this->getCart();
        $count = $cart->items()->sum('quantity');
        return response()->json(['count' => $count]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $cart = $this->getCart();
        $product = Product::where('id', $request->product_id)->orWhere('slug', $request->product_id)->firstOrFail();
        $quantity = $request->quantity ?? 1;

        $cartItem = $cart->items()->where('product_id', $product->id)->first();
        $currentCartQty = $cartItem ? $cartItem->quantity : 0;

        if ($product->is_out_of_stock || $product->stock_quantity <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This product is currently out of stock.'
            ], 400);
        }

        if ($product->stock_quantity < ($currentCartQty + $quantity)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient stock. Only ' . $product->stock_quantity . ' available.'
            ], 400);
        }

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'count' => $cart->items()->sum('quantity')
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $this->getCart();
        $cartItem = $cart->items()->where('id', $request->item_id)->firstOrFail();
        
        if ($cartItem->product->is_out_of_stock || $cartItem->product->stock_quantity <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This product is currently out of stock.'
            ], 400);
        }

        if ($cartItem->product->stock_quantity < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient stock. Only ' . $cartItem->product->stock_quantity . ' available.'
            ], 400);
        }
        
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated successfully!',
            'count' => $cart->items()->sum('quantity')
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id'
        ]);

        $cart = $this->getCart();
        $cart->items()->where('id', $request->item_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Item removed from cart!',
            'count' => $cart->items()->sum('quantity')
        ]);
    }
}
