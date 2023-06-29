<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartControlller extends Controller
{
    public function addProduct(Request $request) {
        $product_id = $request->input('product_id');
        $product_quantity = $request->input('product_quantity');

        if (Auth::check()) {
            $pro_check = Product::where('id', $product_id)->first();

            if ($pro_check) {
                $cartItem = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                if ($cartItem) {
                    $cartItem->product_quantity += $product_quantity;
                    $cartItem->save();
                    return response()->json(['status' => "Product quantity updated in cart successfully."]);
                } else {
                    $cartItem = new Cart();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_quantity = $product_quantity;
                    $cartItem->save();
                    return response()->json(['status' => "Product added to cart successfully."]);
                }
            }
        } else {
            return response()->json(['status' => "Login to continue."]);
        }
    }

    public function shopCart() {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('user.cart', compact('categoryAll', 'cartItems', 'countCart', 'countWish'));
    }

    public function deleteProduct(Request $request) {

        if (Auth::check()) {
            $product_id = $request->input('product_id');

            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Product deleted succesfully."]);
            }

        } else {
            return response()->json(['status' => "Login to continue."]);
        }
    }

    public function updateCart(Request $request) {
        $product_id = $request->input('product_id');
        $product_quantity = $request->input('product_quantity');

        if (Auth::check()) {
            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cart->product_quantity = $product_quantity;
                $cart->update();
                return response()->json(['status' => "Product update quantity succesfully."]);
            }
        }  else {
            return response()->json(['status' => "Login to continue."]);
        }
    }

}
