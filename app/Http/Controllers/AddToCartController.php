<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\cart as ModelsCart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{

    public function index()
    {

        try {
            $cart = Cart::with('items.product')
                ->where('user_id', Auth::id())
                ->first();
            $orders = $cart ? $cart->items : collect();

            return view('web.MyOrders', compact('orders'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong.');
        }
    }
    public function add($id)
    {

        try {

            $product =  ProductsModel::findOrFail($id);

            $cart = cart::firstOrCreate([
                "user_id" => Auth::id()
            ]);


            $item = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            if ($item) {

                $item->quantity += 1;
                $item->save();
            } else {
                // create new item
                CartItem::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $product->id,
                    'quantity'   => 1,
                ]);
            }
            return back()->with('success', 'Product added to cart');
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong.');
        }
    }


    public function myOrders()
    {

        try {
            $orders = Order::with('items.product')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();

            return view('web.talabati', compact('orders'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong.');
        }
    }









    public function deleteCartItem($id)
    {
        try {
            $item = CartItem::findOrFail($id);

            if ($item->cart->user_id !== Auth::id()) {
                abort(403);
            }

            $item->delete();

            return back()->with('success', 'Item removed from cart');
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong.');
        }
    }
}
