<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Cart;
use App\Models\Page;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use Carbon\Carbon;
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
        $user = auth()->user();

        return view('pages.bookings.index', compact('bookings', 'page', 'user'));
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

            $user = auth()->user();
            $startDate = Carbon::parse($cartItems->first()->start_date);
            $endDate = Carbon::parse($cartItems->first()->end_date);
            $totalDays = max($startDate->diffInDays($endDate), 1);

            $totalPrice = 0;
            $productDetails = [];

            // Check voucher validity
            $useNormalPrice = false;
            if ($request->voucher_code) {
                $voucher = Voucher::where('code', $request->voucher_code)
                    ->where('is_active', true)
                    ->first();

                $useNormalPrice = $voucher && $voucher->isValid() && $user->is_member;
            }

            foreach ($cartItems as $item) {
                // Calculate price per day based on voucher usage
                $pricePerDay = $useNormalPrice ? $item->product->price : $item->product->getPriceForUser($user);
                $itemPrice = $pricePerDay * $item->quantity * $totalDays;
                $totalPrice += $itemPrice;

                // Store per-day price and total price in pivot
                $productDetails[$item->product_id] = [
                    'quantity' => $item->quantity,
                    'price' => $pricePerDay, // Store price per day
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Create booking record
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'price' => $totalPrice,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => 'pending',
            ]);

            // Attach products with their details
            $booking->products()->attach($productDetails);

            // Apply voucher discount after products are attached
            if ($request->voucher_code && isset($voucher) && $voucher->isValid()) {
                $discountAmount = $voucher->calculateDiscount($totalPrice);
                $totalPrice -= $discountAmount;

                // Record voucher usage
                $voucher->increment('used_count');
                VoucherUsage::create([
                    'voucher_id' => $voucher->id,
                    'user_id' => auth()->id(),
                    'booking_id' => $booking->id,
                    'discount_amount' => $discountAmount
                ]);

                $booking->price = $totalPrice;
                $booking->save();
            }

            // Clear the cart
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
        $totalDays = max($booking->start_date->diffInDays($booking->end_date), 1);

        return view('pages.bookings.show', compact('booking', 'totalDays', 'page'));
    }
}
