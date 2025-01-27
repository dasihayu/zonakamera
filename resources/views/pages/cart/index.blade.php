@extends('layouts.layout')

@section('content')
    <div class="container p-6 mx-auto">
        <h1 class="mb-6 text-2xl font-bold">Your Cart</h1>

        @if ($cartItems->count() > 0)
            <div class="space-y-4">
                @foreach ($cartItems as $item)
                    <div class="flex items-center justify-between p-4 border rounded">
                        <div>
                            <h3 class="font-bold">{{ $item->product->title }}</h3>
                            <p>Quantity: {{ $item->quantity }}</p>
                            <p>Rental Period: {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') }} to
                                {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="flex items-center">
                            <p class="mr-4 font-bold">Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-2 text-white rounded bg-primary">
                        Create Booking
                    </button>
                </form>
            </div>
        @else
            <p>Your cart is empty</p>
        @endif
    </div>
@endsection
