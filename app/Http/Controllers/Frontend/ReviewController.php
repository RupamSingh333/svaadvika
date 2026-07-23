<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductReview;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:5|max:1000',
        ]);

        $customerId = auth('customer')->id();

        // Check if order belongs to customer and is delivered
        $order = Order::where('id', $request->order_id)
            ->where('user_id', $customerId)
            ->where('status', 'delivered')
            ->firstOrFail();

        // Check if product is in this order
        $orderItem = OrderItem::where('order_id', $order->id)
            ->where('product_id', $request->product_id)
            ->firstOrFail();

        // Check if already reviewed
        $existingReview = ProductReview::where('product_id', $request->product_id)
            ->where('customer_id', $customerId)
            ->where('order_id', $order->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this product from this order.');
        }

        // Create review
        ProductReview::create([
            'product_id' => $request->product_id,
            'customer_id' => $customerId,
            'order_id' => $order->id,
            'rating' => $request->rating,
            'review' => $request->review,
            'is_approved' => true // Auto approve as per plan
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted successfully.');
    }
}
