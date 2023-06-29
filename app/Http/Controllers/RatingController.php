<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    //
    public function add(Request $request) {
        $stars_rated = $request->input('product_rating');
        $product_id = $request->input('product_id');

        $product_check = Product::where('id', $product_id)->get();
        if ($product_check) {
            $verifield = Order::where('orders.user_id', Auth::id())
                        ->join('order_items', 'orders.id', 'order_items.order_id')
                        ->where('order_items.product_id', $product_id)->get();

            if ($verifield) {

                    $existing = Rating::where('user_id', Auth::id())->where('product_id', $product_id)->first();
                if ($existing) {

                    $existing->stars_rated = $stars_rated;
                    $existing->update();
                } else {
                    Rating::create([
                        'user_id' => Auth::id(),
                        'product_id' => $product_id,
                        'stars_rated' => $stars_rated,
                    ]);
                }
                return redirect()->back()->with('success', 'Thank you for product rated.');
            } else {
                return redirect()->back()->with('success', 'You can rate a product.');
            }
        } else {
            return redirect()->back()->with('success', 'The link you followed was broken.');
        }
    }

    public function review(Request $request, $productId) {

        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $review = new Review;
        $review->product_id = $productId;
        $review->user_id = Auth::id();

        $review->user_review = $validatedData['content'];
        $review->save();

        return redirect()->back()->with('success', 'Your review has been submitted successfully.');
    }
}
