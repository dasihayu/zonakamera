@extends('layouts.layout')

@section('title', $product->title)

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container px-4 py-12 mx-auto md:py-12 lg:py-16">
        <div class="flex flex-col gap-8 lg:flex-row">
            <!-- Product Image Section -->
            <div class="w-full lg:w-1/2">
                <div class="overflow-hidden rounded-xl">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->title }}"
                        class="object-cover w-full" />
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="flex flex-col w-full gap-6 lg:w-1/2">
                <!-- Title and Rating -->
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold md:text-3xl lg:text-4xl">{{ $product->title }}</h2>

                    <!-- Rating Section -->
                    <div class="flex items-center gap-4">
                        <div class="flex items-center">
                            @for ($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-600">(4.9 • 120 reviews)</span>
                    </div>
                </div>

                <!-- Price -->
                @if (auth()->user()?->is_member)
                    <div class="flex flex-col items-start gap-1">
                        <span class="text-gray-500 line-through">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        <div class="flex items-center gap-2">
                            <span class="text-2xl font-bold text-primary">
                                Rp{{ number_format($product->getPriceForUser(auth()->user()), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                @else
                    <span class="text-2xl font-bold text-primary">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </span>
                @endif

                <!-- Categories -->
                <div class="flex flex-wrap items-center gap-2">
                    @foreach ($product->categories as $category)
                        <span class="px-2 py-1 bg-blue-100 border rounded-full text-md text-primary border-primary-light">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                <!-- Description -->
                <div class="p-4 rounded-lg bg-gray-50">
                    <h3 class="mb-2 text-lg font-semibold">Description</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                </div>

                <!-- Rental Features -->
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                    <div class="p-3 text-center rounded-lg bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto mb-2 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium">24/7 Support</p>
                    </div>
                    <div class="p-3 text-center rounded-lg bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto mb-2 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium">Quality Assured</p>
                    </div>
                    <div class="p-3 text-center rounded-lg bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto mb-2 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p class="text-sm font-medium">Secure Payment</p>
                    </div>
                    <div class="p-3 text-center rounded-lg bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto mb-2 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8h13M3 8l4-4m-4 4l4 4m13 0h-4m0 0l4-4m-4 4l4 4" />
                        </svg>
                        <p class="text-sm font-medium">Free Delivery</p>
                    </div>
                </div>

                <!-- Action Button -->
                @if (Auth::check())
                    <button onclick="addToCart({{ $product->id }})"
                        class="w-full px-6 py-4 text-lg font-semibold text-white transition-colors rounded-lg bg-primary hover:bg-primary-dark">
                        Add to Cart
                    </button>
                @else
                    <a href="{{ route('login') }}"
                        class="block w-full px-6 py-4 text-lg font-semibold text-center text-white transition-colors rounded-lg bg-primary hover:bg-primary-dark">
                        Login to Rent
                    </a>
                @endif
            </div>
        </div>
    </div>

    <script>
        function addToCart(productId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            if (!csrfToken) {
                Swal.fire('Error', 'CSRF token not found. Please refresh the page.', 'error');
                return;
            }

            Swal.fire({
                title: 'Rental Details',
                html: `
            <div class="space-y-4 text-left">
                <div class="flex flex-col">
                    <label for="start_date" class="mb-1 font-semibold">Start Date</label>
                    <input type="datetime-local" id="start_date" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="flex flex-col">
                    <label for="end_date" class="mb-1 font-semibold">End Date</label>
                    <input type="datetime-local" id="end_date" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="flex flex-col">
                    <label for="quantity" class="mb-1 font-semibold">Quantity</label>
                    <input type="number" id="quantity" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary" min="1" value="1">
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
                preConfirm: () => {
                    const startDate = document.getElementById('start_date').value;
                    const endDate = document.getElementById('end_date').value;
                    const quantity = document.getElementById('quantity').value;

                    return fetch('/cart/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                start_date: startDate,
                                end_date: endDate,
                                quantity: quantity
                            })
                        })
                        .then(response => response.json())
                        .catch(error => Swal.showValidationMessage(`Request failed: ${error}`));
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Product added to cart.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'px-4 py-2 text-white bg-primary rounded hover:bg-blue-700',
                        },

                    });
                }
            });
        }
    </script>
@endsection
