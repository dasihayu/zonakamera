@extends('layouts.layout')

@section('title', 'Bookings')

@section('content')
    <!-- Hero Section -->
    <div class="relative">
        <!-- Background Image -->
        <img src="{{ asset('storage/' . $page->booking_banner) }}" alt="Hero Image"
            class="object-cover w-full max-h-80 blur-sm" />
        <!-- Headline -->
        <div class="absolute inset-0 flex flex-col items-center justify-center mt-16 text-center">
            <h1 class="text-6xl font-extrabold text-white md:text-8xl drop-shadow-lg">
                @yield('title')
            </h1>
        </div>
    </div>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Page Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Bookings</h1>

                <!-- Filter Form -->
                <form action="{{ route('bookings.index') }}" method="GET" class="flex gap-4">
                    <div class="flex items-center gap-2">
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                        <span class="text-gray-500">to</span>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                    </div>
                    <button type="submit" class="px-4 py-2 text-white rounded-md bg-primary hover:bg-primary-dark">
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

            <!-- Bookings List -->
            @if ($bookings->count() > 0)
                <div class="overflow-hidden bg-white shadow sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                            <li>
                                <a href="{{ route('bookings.show', $booking) }}" class="block hover:bg-gray-50">
                                    <div class="px-4 py-4 sm:px-6">
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
                                            <div class="flex flex-shrink-0 ml-2">
                                                <p
                                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                    Active
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-2 sm:flex sm:justify-between">
                                            <div class="sm:flex">
                                                <div class="flex items-center text-sm text-gray-500">
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach ($booking->products as $product)
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                {{ $product->title }} ({{ $product->pivot->quantity }})
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-2 text-sm text-gray-500 sm:mt-0">
                                                <p class="font-medium text-gray-900">
                                                    Rp{{ number_format($booking->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Pagination -->
                <div class="mt-8">
                    <div class="flex items-center justify-center gap-4">
                        {{-- Previous Page Link --}}
                        @if ($bookings->onFirstPage())
                            <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $bookings->previousPageUrl() }}"
                                class="px-4 py-2 rounded text-primary hover:text-white hover:bg-primary-light">Previous</a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $pageNumber => $url)
                            @if ($pageNumber == $bookings->currentPage())
                                <span
                                    class="px-4 py-2 text-white rounded bg-primary hover:text-white">{{ $pageNumber }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-4 py-2 rounded text-primary hover:text-white hover:bg-primary-light">{{ $pageNumber }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($bookings->hasMorePages())
                            <a href="{{ $bookings->nextPageUrl() }}"
                                class="px-4 py-2 rounded text-primary hover:text-white hover:bg-primary-light">Next</a>
                        @else
                            <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            @else
                <div class="py-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
