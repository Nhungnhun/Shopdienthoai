<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    //
    public function shopIndex() {
        $categoryAll = Category::all();
        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        // $products = Product::paginate(6);
        $products = Product::withCount('wishlist')->paginate(6);
        return view('user.shop', compact('products', 'categoryAll', 'countCart', 'countWish'));
    }

    public function shopSort(Request $request) {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        $total_wish = Wishlist::all();
        $totalList = $total_wish->count();

        $sort = $request->input('sort');

        if ($sort == 'status') {
            $products = Product::orderBy('status', 'desc')->paginate(6);
        } else if ($sort == 'trending') {
            $products = Product::orderBy('trending', 'desc')->paginate(6);
        } else {
            $products = Product::paginate(9);
        }

        return view('user.shop', compact('products', 'categoryAll', 'countCart', 'countWish', 'totalList'));
    }

    public function search(Request $request) {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        $validator = Validator::make($request->all(), [
            'searchTerm' => 'required',
        ], [
            'searchTerm.required' => 'Please enter search keyword.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $searchTerm = $request->input('searchTerm');
        $productSearch = Product::withCount('wishlist')->where('name', 'like', '%'.$searchTerm.'%')->paginate(6);
        return view('user.shop', compact('productSearch', 'categoryAll', 'countCart', 'countWish'));
    }

    public function searchPrice(Request $request) {

        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        $priceAll = $request->has('price-all');
        $price1 = $request->has('price-1');
        $price2 = $request->has('price-2');
        $price3 = $request->has('price-3');
        $price4 = $request->has('price-4');

        $check = [ $priceAll, $price1, $price2,  $price3, $price4];
        $priceCheck = collect($check)->contains(1);
        $query = Product::query();

        if (!$priceAll) {
            if ($price1) {
                $query->whereBetween('selling_price', [0, 5000000]);
            }
            if ($price2) {
                $query->whereBetween('selling_price', [5000000, 10000000]);
            }
            if ($price3) {
                $query->whereBetween('selling_price', [10000000, 20000000]);
            }
            if ($price4) {
                $query->whereBetween('selling_price', [20000000, 50000000]);
            }
        }

        $productPrice = $query->withCount('wishlist')->paginate(6);

        return view('user.shop', compact('productPrice', 'priceCheck', 'categoryAll', 'countCart', 'countWish'));
    }
}
