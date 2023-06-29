<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function index() {
        $categoryAll = Category::all();
        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();

        return view('user.wishlist', compact('categoryAll', 'wishlist', 'countCart', 'countWish'));
    }

    public function add(Request $request) {
        if (Auth::check()) {
            $product_id = $request->input('product_id');
            if (Product::find($product_id)) {
                if (Wishlist::where('product_id', $product_id)->where('user_id', Auth::user()->id)->exists()) {
                    return response()->json(['status' => "Product already exists in Wishlist."]);
                }

                $wish = new Wishlist();

                $wish->product_id = $product_id;
                $wish->user_id = Auth::user()->id;

                $wish->save();
                return response()->json(['status' => "Product add to Wishlist."]);
            } else {
                return response()->json(['status' => "Product does't exist."]);
            }
        } else {
            return response()->json(['status' => "Login to continue."]);
        }
    }

    public function destroy(Request $request) {
        if (Auth::check()) {
            $product_id = $request->input('product_id');

            if (Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $wish = Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "Item removed wishlist succesfully."]);
            }

        } else {
            return response()->json(['status' => "Login to continue."]);
        }
    }
}
