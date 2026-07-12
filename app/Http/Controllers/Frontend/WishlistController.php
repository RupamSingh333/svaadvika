<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    private function getWishlist()
    {
        if (Auth::guard('customer')->check()) {
            return Wishlist::firstOrCreate(
                ['customer_id' => Auth::guard('customer')->id()],
                ['session_id' => session()->getId()]
            );
        }

        return Wishlist::firstOrCreate(
            ['session_id' => session()->getId()],
            ['customer_id' => null]
        );
    }

    public function getCount()
    {
        $wishlist = $this->getWishlist();
        $count = $wishlist->items()->count();
        return response()->json(['count' => $count]);
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $wishlist = $this->getWishlist();
        $product = Product::findOrFail($request->product_id);

        $wishlistItem = $wishlist->items()->where('product_id', $product->id)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            $action = 'removed';
            $message = 'Product removed from wishlist!';
        } else {
            $wishlist->items()->create([
                'product_id' => $product->id
            ]);
            $action = 'added';
            $message = 'Product added to wishlist!';
        }

        return response()->json([
            'status' => 'success',
            'action' => $action,
            'message' => $message,
            'count' => $wishlist->items()->count()
        ]);
    }
}
