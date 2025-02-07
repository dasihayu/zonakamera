@extends('layouts.layout')

@section('title', 'Bookings')

@section('content')
    <!-- Hero Section -->
    <div class="relative">
        <!-- Background Image -->
        <img src="{{ asset('storage/' . $page->booking_banner) }}" alt="Hero Image"
            class="object-cover w-full max-h-80 md:max-h-96 lg:max-h-[600px] blur-sm" />
        <!-- Headline -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
            <h1 class="text-6xl font-extrabold text-white md:text-8xl drop-shadow-lg">
                @yield('title')
            </h1>
        </div>
    </div>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="container p-6 mx-auto">
                <div class="flex flex-col gap-6 md:flex-row">
                    <!-- User Profile Section -->
                    <div class="w-full p-6 bg-white rounded-lg shadow-md md:w-1/4">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-20 h-20 mb-4 overflow-hidden border-4 rounded-full border-primary">
                                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                                    alt="User Avatar" class="object-cover w-full h-full">
                            </div>
                            <p class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center gap-2 p-2 text-gray-600">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 10s4-6 9-6 9 6 9 6-4 6-9 6-9-6-9-6z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span>{{ auth()->user()->phone ?: 'No phone number' }}</span>
                            </div>
                            <div class="flex items-center gap-2 p-2 text-gray-600">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4M8 2v4m-4 4h16" />
                                </svg>
                                <span>Joined since {{ auth()->user()->created_at->format('M Y') }}</span>
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="p-2 bg-red-500 rounded-md">
                                @csrf
                                <button type="submit" class="flex items-center w-full gap-2 text-white ">
                                    <i class="mr-2 fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Bookings List Section -->
                    <div class="w-full p-4 bg-white rounded shadow md:w-3/4">
                        <!-- Page Header -->
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="text-2xl font-bold text-gray-900">Your Bookings</h1>

                            <!-- Filter Form -->
                            <form action="{{ route('bookings.index') }}" method="GET" class="hidden gap-4 md:flex">
                                <div class="flex items-center gap-2">
                                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                                        class="border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                                    <span class="text-gray-500">to</span>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                                        class="border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                                </div>
                                <button type="submit"
                                    class="px-4 py-2 text-white rounded-md bg-primary hover:bg-primary-dark">
                                    Filter
                                </button>
                                @if (request()->hasAny(['start_date', 'end_date']))
                                    <a href="{{ route('bookings.index') }}"
                                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                                        Reset
                                    </a>
                                @endif
                            </form>
                        </div>
                        @if ($bookings->count() > 0)
                            <div class="space-y-4">
                                @foreach ($bookings as $booking)
                                    <div class="p-2 border rounded-lg border-primary">
                                        <a href="{{ route('bookings.show', $booking) }}"
                                            class="relative block hover:bg-gray-50">
                                            <div class="px-4 py-4 sm:px-6">
                                                {{-- Badge di pojok kanan atas --}}
                                                @php
                                                    $statusColors = [
                                                        'completed' => 'bg-green-500',
                                                        'pending' => 'bg-yellow-500',
                                                        'confirmed' => 'bg-blue-500',
                                                        'canceled' => 'bg-red-500',
                                                        'not returned' => 'bg-red-500',
                                                        'picked up' => 'bg-blue-500',
                                                    ];
                                                @endphp

                                                <div
                                                    class="absolute top-2 right-2 px-3 py-1 text-xs font-semibold text-white rounded-full {{ $statusColors[$booking->status] ?? 'bg-gray-500' }}">
                                                    {{ ucfirst($booking->status) }}
                                                </div>


                                                <div class="flex items-center justify-between">
                                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-4">
                                                        <p class="text-sm font-medium truncate text-primary">
                                                            Booking #{{ $booking->id }}
                                                        </p>
                                                        <div class="flex items-center gap-2 text-sm text-gray-500">
                                                            <span>{{ $booking->start_date->format('d M Y') }}</span>
                                                            <span>-</span>
                                                            <span>{{ $booking->end_date->format('d M Y') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-2 sm:flex sm:justify-between">
                                                    <div class="sm:flex">
                                                        <div class="flex items-center text-sm text-gray-500">
                                                            <div class="flex flex-wrap gap-2">
                                                                @foreach ($booking->products as $product)
                                                                    <span
                                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                        {{ $product->title }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Total harga di pojok kanan bawah --}}
                                                    <div class="flex items-center mt-2 text-sm text-gray-500 sm:mt-0">
                                                        <p class="font-medium text-gray-900">
                                                            Rp{{ number_format($booking->price, 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="mt-8">
                                <div class="flex flex-wrap items-center justify-center gap-2 md:gap-4">
                                    {{-- Previous Page Link --}}
                                    @if ($bookings->onFirstPage())
                                        <span
                                            class="px-2 py-1 text-gray-400 cursor-not-allowed md:px-4 md:py-2">Previous</span>
                                    @else
                                        <a href="{{ $bookings->previousPageUrl() }}"
                                            class="px-2 py-1 rounded text-primary hover:text-white hover:bg-primary-light md:px-4 md:py-2">Previous</a>
                                    @endif

                                    {{-- Page Numbers --}}
                                    @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $pageNumber => $url)
                                        @if ($pageNumber == $bookings->currentPage())
                                            <span
                                                class="px-2 py-1 text-white rounded bg-primary hover:text-white md:px-4 md:py-2">{{ $pageNumber }}</span>
                                        @else
                                            <a href="{{ $url }}"
                                                class="px-2 py-1 rounded text-primary hover:text-white hover:bg-primary-light md:px-4 md:py-2">{{ $pageNumber }}</a>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($bookings->hasMorePages())
                                        <a href="{{ $bookings->nextPageUrl() }}"
                                            class="px-2 py-1 rounded text-primary hover:text-white hover:bg-primary-light md:px-4 md:py-2">Next</a>
                                    @else
                                        <span class="px-2 py-1 text-gray-400 cursor-not-allowed md:px-4 md:py-2">Next</span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="py-12 text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No bookings found</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new booking.</p>
                                <div class="mt-6">
                                    <a href="{{ route('products') }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Browse Products
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Highlight active filters
            document.addEventListener('DOMContentLoaded', function() {
                const startDate = document.querySelector('input[name="start_date"]');
                const endDate = document.querySelector('input[name="end_date"]');

                if (startDate.value || endDate.value) {
                    startDate.classList.add('border-primary');
                    endDate.classList.add('border-primary');
                }
            });
        </script>
    @endpush
@endsection
