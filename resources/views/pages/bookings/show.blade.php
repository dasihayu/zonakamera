@extends('layouts.layout')

@section('title', 'Booking Details')

@section('content')
    <!-- Hero Section -->
    <div class="relative">
        <!-- Background Image -->
        <img src="{{ asset('storage/' . $page->booking_banner) }}" alt="Hero Image"
            class="object-cover w-full max-h-80 md:max-h-96 blur-sm" />
        <!-- Headline -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
            <h1 class="text-6xl font-extrabold text-white md:text-8xl drop-shadow-lg">
                @yield('title')
            </h1>
        </div>
    </div>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Booking Header -->
            <div class="overflow-hidden bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Booking #{{ $booking->booking_id }}</h1>
                            <p class="mt-1 text-sm text-gray-500">
                                Created on {{ $booking->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        @php
                            $statusColors = [
                                'completed' => 'bg-green-500',
                                'pending' => 'bg-yellow-500',
                                'confirmed' => 'bg-green-500',
                                'canceled' => 'bg-red-500',
                                'not returned' => 'bg-red-500',
                                'picked up' => 'bg-blue-500',
                            ];
                            $statusIcons = [
                                'completed' => 'fas fa-check-circle',
                                'pending' => 'fas fa-hourglass-half',
                                'confirmed' => 'fas fa-check',
                                'canceled' => 'fas fa-times-circle',
                                'not returned' => 'fas fa-exclamation-circle',
                                'picked up' => 'fas fa-truck',
                            ];
                        @endphp
                        <div class="flex items-center justify-center">
                            <span
                                class="inline-flex px-3 py-1 text-sm font-semibold leading-5 text-white rounded-full {{ $statusColors[$booking->status] ?? 'bg-gray-500' }}">
                                <i class="{{ $statusIcons[$booking->status] ?? 'fas fa-info-circle' }} mr-1"></i>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="mt-6 overflow-hidden bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Rental Details</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Start Date</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->start_date->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">End Date</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->end_date->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Duration</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $totalDays }} days</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booked Items -->
            <div class="mt-6 overflow-hidden bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Booked Items</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($booking->products as $product)
                            <div
                                class="flex items-center justify-between pb-4 border-b border-gray-200 last:border-b-0 last:pb-0">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->title }}"
                                        class="object-cover w-16 h-16 rounded">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">{{ $product->title }}</h3>
                                        <p class="text-sm text-gray-500">Quantity: {{ $product->pivot->quantity }}</p>
                                        <p class="text-sm text-gray-500">
                                            Price per day:
                                            Rp{{ number_format($product->pivot->price / $totalDays, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">
                                        Rp{{ number_format($product->pivot->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Total Summary -->
            <div class="mt-6 overflow-hidden bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-medium text-gray-900">Total Amount</p>
                            <p class="text-sm text-gray-500">Including all items for {{ $totalDays }} days</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">
                                Rp{{ number_format($booking->price, 0, ',', '.') }}
                            </p>
                            @if($booking->voucherUsage)
                                <p class="text-sm text-gray-500">
                                    Harga setelah menggunakan voucher
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end mt-6 space-x-3">
                <a href="{{ route('bookings.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                    Back to Bookings
                </a>
                <a href="{{ route('invoice.download', $booking->id) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-primary hover:bg-primary-dark">
                    Download Invoice
                </a>
            </div>
        </div>
    </div>
@endsection
