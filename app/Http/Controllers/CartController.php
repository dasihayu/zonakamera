<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Page;
use App\Models\Product;
use Carbon\Carbon;
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
        $price = $product->getPriceForUser(auth()->user());

        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json(['message' => 'Product added to cart']);
    }

    public function viewCart()
    {
        $page = Page::first();
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $totalPrice = $cartItems->sum(function ($item) {
            $startDate = Carbon::parse($item->start_date);
            $endDate = Carbon::parse($item->end_date);
            $totalDays = max($startDate->diffInDays($endDate), 1); // Minimum 1 day

            return $item->product->price * $item->quantity * $totalDays;
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
