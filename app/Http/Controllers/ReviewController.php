<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    // Lưu review
    public function store(Request $request, $orderId, $productId)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $order = Order::with('items')->findOrFail($orderId);

        // Kiểm tra xem user có phải là chủ đơn hàng không
        if ($order->user_id !== auth()->id()) {
            return back()->with('error', 'Bạn không có quyền đánh giá sản phẩm này.');
        }

        // Kiểm tra sản phẩm có nằm trong đơn hàng không
        $item = $order->items->where('product_id', $productId)->first();
        if (!$item) {
            return back()->with('error', 'Sản phẩm không thuộc đơn hàng.');
        }

        // Tạo hoặc cập nhật review
        Review::updateOrCreate(
            [
                'user_id'    => auth()->id(),
                'product_id' => $productId,
                'order_id'   => $orderId,
            ],
            [
                'rating'  => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return back()->with('success', 'Đánh giá của bạn đã được lưu.');
    }

    // Hiển thị review theo sản phẩm
    public function showProductReviews($productId)
    {
        $product = Product::with('reviews.user')->findOrFail($productId);

        return view('products.reviews', compact('product'));
    }
}
