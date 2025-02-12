@extends('layouts.layout')

@section('title', 'Bookings')

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
                                    <div
                                        class="overflow-hidden transition-shadow duration-300 border rounded-lg border-primary hover:shadow-lg">
                                        <a href="{{ route('bookings.show', $booking) }}" class="block">
                                            <div class="p-4 sm:p-6">
                                                <!-- Header: Booking ID and Status -->
                                                <div
                                                    class="flex flex-col gap-3 mb-4 sm:items-center sm:justify-between sm:flex-row">
                                                    <div
                                                        class="flex flex-col space-y-2 sm:flex-row sm:items-center sm:space-y-0 sm:space-x-4">
                                                        <span
                                                            class="text-sm font-medium text-primary">#{{ $booking->booking_id }}</span>
                                                        <div class="flex items-center space-x-2 text-sm text-gray-600">
                                                            <svg class="flex-shrink-0 w-4 h-4" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                            <span class="text-xs sm:text-sm">
                                                                {{ $booking->start_date->format('d M Y') }} -
                                                                {{ $booking->end_date->format('d M Y') }}
                                                            </span>
                                                        </div>
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

                                                    <span
                                                        class="inline-flex items-center self-start px-3 py-1 text-xs font-medium text-white rounded-full sm:text-sm sm:self-center {{ $statusColors[$booking->status] ?? 'bg-gray-500' }}">
                                                        <i
                                                            class="{{ $statusIcons[$booking->status] ?? 'fas fa-info-circle' }} mr-2"></i>
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                </div>

                                                <!-- Products List -->
                                                <div class="mb-4">
                                                    <h4 class="mb-2 text-sm font-medium text-gray-700 sm:hidden">Products:
                                                    </h4>
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach ($booking->products as $product)
                                                            <span
                                                                class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 rounded-full sm:px-3 sm:text-sm text-primary">
                                                                {{ $product->title }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <!-- Footer: Price -->
                                                <div class="flex items-center justify-between sm:justify-end">
                                                    <span class="text-sm font-medium text-gray-600 sm:hidden">Total
                                                        Price:</span>
                                                    <div class="text-base font-semibold text-gray-900 sm:text-lg">
                                                        Rp{{ number_format($booking->price, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- Review Button (if applicable) -->
                                        @if ($booking->status === 'completed' && !$booking->review)
                                            <div class="px-4 py-3 bg-gray-50 sm:px-6">
                                                <button onclick="showReviewModal('{{ $booking->id }}')"
                                                    class="flex items-center justify-center w-full px-3 py-2 text-xs font-medium text-white transition-colors duration-200 rounded-md sm:text-sm sm:px-4 bg-primary hover:bg-primary-dark">
                                                    <i class="mr-2 fas fa-star"></i>
                                                    Leave Review
                                                </button>
                                            </div>
                                        @endif
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
                                        <span
                                            class="px-2 py-1 text-gray-400 cursor-not-allowed md:px-4 md:py-2">Next</span>
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

            function showReviewModal(bookingId) {
                // Create star SVG elements with better interaction
                let stars = '';
                for (let i = 1; i <= 5; i++) {
                    stars += `
            <svg class="w-10 h-10 transition-colors duration-200 ease-in-out cursor-pointer star hover:scale-110" 
                 data-rating="${i}" 
                 fill="currentColor" 
                 viewBox="0 0 24 24"
                 style="color: #d1d5db;">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>`;
                }

                Swal.fire({
                    title: '<span class="text-xl font-semibold text-gray-800">Rate your experience</span>',
                    html: `
            <div class="flex flex-col items-center space-y-4">
                <div class="flex justify-center space-x-2" id="starContainer">
                    ${stars}
                </div>
                <div class="w-full max-w-lg mt-4">
                    <textarea id="review-comment" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" 
                        rows="4"
                        placeholder="Share your experience (optional)"></textarea>
                </div>
            </div>
        `,
                    showCancelButton: true,
                    confirmButtonText: 'Add to Cart',
                    confirmButtonColor: '#00457F',
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: '#EF4444',
                    customClass: {
                        popup: 'rounded-lg shadow-lg p-6',
                        title: 'text-lg font-bold',
                        confirmButton: 'px-4 py-2 text-white bg-primary rounded hover:bg-blue-700',
                        cancelButton: 'px-4 py-2 text-white bg-gray-200 rounded hover:bg-gray-300',
                    },
                    didOpen: (modal) => {
                        const starContainer = modal.querySelector('#starContainer');
                        let selectedRating = 0;
                        const stars = starContainer.querySelectorAll('.star');

                        // Function to update stars appearance
                        function updateStars(rating, isHover = false) {
                            stars.forEach((star, index) => {
                                if (index < rating) {
                                    star.style.color = '#FBBF24'; // Yellow color for selected stars
                                } else {
                                    star.style.color = isHover ? '#d1d5db' : (index < selectedRating ?
                                        '#FBBF24' : '#d1d5db');
                                }
                            });
                        }

                        // Handle hover effects
                        stars.forEach((star, index) => {
                            star.addEventListener('mouseover', () => {
                                updateStars(index + 1, true);
                            });

                            star.addEventListener('mouseout', () => {
                                updateStars(selectedRating);
                            });

                            star.addEventListener('click', () => {
                                selectedRating = index + 1;
                                updateStars(selectedRating);
                            });
                        });

                        // Remove hover when mouse leaves container
                        starContainer.addEventListener('mouseleave', () => {
                            updateStars(selectedRating);
                        });
                    },
                    preConfirm: () => {
                        const stars = document.querySelectorAll('.star');
                        let rating = 0;
                        stars.forEach((star) => {
                            if (star.style.color === 'rgb(251, 191, 36)') { // #FBBF24 in RGB
                                rating++;
                            }
                        });

                        if (rating === 0) {
                            Swal.showValidationMessage('Please select a rating');
                            return false;
                        }

                        const comment = document.getElementById('review-comment').value;

                        return fetch(`/reviews`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    booking_id: bookingId,
                                    rating: rating,
                                    comment: comment
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText);
                                }
                                return response.json();
                            })
                            .catch(error => {
                                Swal.showValidationMessage(`Request failed: ${error}`);
                            });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Thank you!',
                            text: 'Your review has been submitted successfully.',
                            icon: 'success',
                            confirmButtonColor: '#4F46E5',
                            customClass: {
                                popup: 'rounded-lg',
                                confirmButton: 'px-6 py-2.5 rounded-lg text-sm font-medium'
                            }
                        }).then(() => {
                            // Optional: Reload the page to show updated review status
                            window.location.reload();
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
