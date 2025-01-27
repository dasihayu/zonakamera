<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date'
        ]);

        $product = Product::findOrFail($request->product_id);

        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->product_id
            ],
            [
                'quantity' => $request->quantity,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]
        );

        return response()->json(['message' => 'Product added to cart']);
    }

    public function viewCart()
    {
        $page = Page::first();
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $totalPrice = $cartItems->sum(function ($item) {
            $days = \Carbon\Carbon::parse($item->start_date)->diffInDays(\Carbon\Carbon::parse($item->end_date));
            return $item->product->price * $item->quantity * $days;
        });

        return view('pages.cart.index', compact('cartItems', 'totalPrice', 'page'));
    }

    public function deleteCartItem($id)
    {
        $cartItem = Cart::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart']);
    }
}
