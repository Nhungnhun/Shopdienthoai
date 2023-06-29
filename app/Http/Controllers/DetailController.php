<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function detail($id) {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        $product = Product::where('id', $id)->first();
        $reviews = $product->reviews()->get();

        $ratings = Rating::where('product_id', $product->id)->get();
        $rating_sum = Rating::where('product_id', $product->id)->sum('stars_rated');

        if ($ratings->count() > 0) {
            $rating_value = $rating_sum / $ratings->count();
        } else {
            $rating_value = 0;
        }


        $category = Category::where('id', $product->cate_id)->first();
        return view('user.detail', compact('categoryAll', 'product', 'category', 'countCart', 'countWish', 'ratings', 'rating_value', 'reviews'));
    }

    public function more(Request $request, $id)
    {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        $page = $request->page;

        $product = Product::findOrFail($id);
        $reviews = $product->reviews()->skip(($page - 1) * 5)->take(5)->get();
    }
}
