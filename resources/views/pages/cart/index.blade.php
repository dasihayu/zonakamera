@extends('layouts.layout')
@section('title', 'Cart')

@section('content')
    <!-- Hero Section -->
    <div class="relative">
        <!-- Background Image -->
        <img src="{{ asset('storage/' . $page->cart_banner) }}" alt="Hero Image"
            class="object-cover w-full max-h-80 md:max-h-96 blur-sm" />
        <!-- Headline -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
            <h1 class="text-6xl font-extrabold text-white md:text-8xl drop-shadow-lg">
                @yield('title')
            </h1>
        </div>
    </div>
    <div class="container p-6 mx-auto">
        @if ($cartItems->count() > 0)
            <h1 class="mb-6 text-2xl font-bold">Your Cart</h1>
            <div class="space-y-4">
                @foreach ($cartItems as $item)
                    <div
                        class="flex flex-col items-center justify-between p-4 space-y-4 border rounded sm:flex-row sm:space-y-0 sm:space-x-4">
                        <div class="w-full sm:w-3/4">
                            <h3 class="text-lg font-bold">{{ $item->product->title }}</h3>
                            <p>Quantity: {{ $item->quantity }}</p>
                            <p>Price per day: Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                            <p>Rental Period: {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') }} to
                                {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="flex items-center justify-between w-full sm:justify-end sm:w-1/4">
                            <p class="mr-4 text-xl font-bold">
                                Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </p>
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 mt-2 text-white bg-red-500 rounded sm:mt-0">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-start mt-6">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-2 text-white rounded bg-primary hover:bg-primary-dark">
                        Create Booking
                    </button>
                </form>
            </div>
        @else
            <div class="py-12 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by adding products.</p>
                <div class="mt-6">
                    <a href="{{ route('products') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Browse Products
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
