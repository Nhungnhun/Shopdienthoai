<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        $categoryAll = Category::all();

        $cart = Cart::where('user_id', Auth::id())->get();
        $countCart = $cart->count();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $countWish = $wishlist->count();

        $oldCartItems = Cart::where('user_id', Auth::id())->get();
        if ($oldCartItems->count() == 0) {
            return redirect()->route('cart')->with('success', 'Your cart is empty.');
        }
        foreach ($oldCartItems as $item) {
            $product = Product::find($item->product_id);
            if (!$product || $item->product_quantity > $product->qty) {
                $removeItem = Cart::where('user_id', Auth::id())->where('product_id', $item->product_id)->first();
                $removeItem->delete();
            }
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('user.checkout', compact('categoryAll', 'cartItems', 'countCart', 'countWish'));
    }

    public function placeOrder(Request $request)
    {
        $order = new Order();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => ['required', 'string', 'regex:/^(0\d{9,10})$/'],
            'address' => 'required|string|max:255',
        ]);
        $order->user_id = Auth::user()->id;
        $order->name = $validatedData['name'];
        $order->email = $request->input('email');
        $order->mobile = $validatedData['mobile'];
        $order->address = $validatedData['address'];
        $order->tracking_no = 'success' . random_int(111, 999);

        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems_total as $prod) {
            $total += $prod->products->selling_price;
        }
        $order->total_price = $total;

        $order->save();

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->product_quantity,
                'price' => $item->products->selling_price,
            ]);
            $product = Product::where('id', $item->product_id)->first();
            $product->qty = $product->qty - $item->product_quantity;
            $product->update();
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);

        return redirect('/home')->with('success', 'Order place successfully.');
    }
}
