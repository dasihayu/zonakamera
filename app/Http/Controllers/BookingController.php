<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Cart;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{

    public function index(Request $request)
    {
        $page = Page::first();
        $query = Booking::where('user_id', auth()->id())
            ->with('products')
            ->latest();

        // Filter by date range if provided
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('start_date', [
                $request->start_date,
                $request->end_date
            ]);
        }

        $bookings = $query->paginate(10);

        return view('pages.bookings.index', compact('bookings', 'page'));
    }

    public function createBooking(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $cartItems = Cart::where('user_id', auth()->id())
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Cart is empty');
            }

            $totalPrice = $cartItems->sum(function ($item) {
                $days = \Carbon\Carbon::parse($item->start_date)->diffInDays(\Carbon\Carbon::parse($item->end_date));
                return $item->product->price * $item->quantity * $days;
            });

            $booking = Booking::create([
                'user_id' => auth()->id(),
                'price' => $totalPrice,
                'start_date' => $cartItems->first()->start_date,
                'end_date' => $cartItems->first()->end_date
            ]);

            foreach ($cartItems as $item) {
                $days = \Carbon\Carbon::parse($item->start_date)->diffInDays(\Carbon\Carbon::parse($item->end_date));
                $itemPrice = $item->product->price * $days;

                $booking->products()->attach($item->product_id, [
                    'quantity' => $item->quantity,
                    'price' => $itemPrice
                ]);
            }

            Cart::where('user_id', auth()->id())->delete();

            return redirect()->route('bookings.show', $booking->id)
                ->with('success', 'Booking created successfully');
        });
    }

    public function show(Booking $booking)
    {
        $page = Page::first();
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->load('products'); // Eager load products relation

        // Menghitung total hari
        $totalDays = $booking->start_date->diffInDays($booking->end_date) + 1;

        return view('pages.bookings.show', compact('booking', 'totalDays', 'page'));
    }
}
