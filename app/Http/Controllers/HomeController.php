<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();


        $productTrending = Product::withCount('wishlist')->where('trending', '!=', '0')->get();
        $productPopular = Product::withCount('wishlist')->where('status', '!=', '0')->get();

        return view('user.index', compact('categoryAll', 'productTrending', 'productPopular', 'countCart', 'countWish'));
    }


    public function contact() {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        $total_wish = Wishlist::all();
        $totalList = $total_wish->count();

        return view('user.contact', compact('categoryAll', 'countCart', 'countWish', 'totalList'));
    }

    public function myOrder() {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $cart->count();

        $total_wish = Wishlist::all();
        $totalList = $total_wish->count();

        $orders = Order::where('user_id', Auth::id())->paginate(10);

        return view('user.orders.index', compact('categoryAll', 'orders', 'countCart', 'countWish', 'totalList'));
    }

    public function viewOrder($id) {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();

        $total_wish = Wishlist::all();
        $totalList = $total_wish->count();

        return view('user.orders.detail', compact('categoryAll', 'orders', 'countCart', 'countWish', 'totalList'));
    }
}
