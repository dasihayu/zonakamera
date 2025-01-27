@extends('layouts.layout')

@section('title', 'Product')

@section('content')
    <!-- Hero Section -->
    <div class="relative {{ request()->is('/') ? 'hidden' : '' }}">
        <!-- Background Image -->
        <img src="{{ asset('storage/' . $page->product_banner) }}" alt="Hero Image"
            class="object-cover w-full max-h-80 blur-sm" />
        <!-- Headline -->
        <div class="absolute inset-0 flex flex-col items-center justify-center mt-16 text-center">
            <h1 class="text-6xl font-extrabold text-white md:text-8xl drop-shadow-lg">
                @yield('title')
            </h1>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="flex flex-col items-center justify-center w-full p-6 my-12">
        <div class="flex flex-col w-full max-w-screen-lg md:flex-row">
            <!-- Sidebar Filter -->
            <div class="w-full p-4 bg-gray-100 rounded-lg md:w-1/4">
                <form action="{{ route('products') }}" method="GET">
                    <!-- Search -->
                    <div class="mb-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search products..." class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-4">
                        <p class="mb-2 font-bold">Categories</p>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('products', ['category' => '']) }}"
                                class="px-4 py-2 text-sm rounded-lg w-full {{ request('category') == '' ? 'bg-primary text-white' : 'bg-gray-200 text-black' }}">
                                All
                            </a>
                            @foreach ($categories as $category)
                                <a href="{{ route('products', ['category' => $category->name]) }}"
                                    class="px-4 py-2 text-sm rounded-lg w-full {{ request('category') == $category->name ? 'bg-primary text-white' : 'bg-gray-200 text-black' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-4">
                        <p class="mb-2 font-bold">Price Range</p>
                        <div class="relative">
                            <!-- Price Range Slider -->
                            <input type="range" name="price_range" id="priceRange" min="0" max="2000000"
                                step="50000" value="{{ request('price_range', 2000000) }}" class="w-full cursor-pointer"
                                oninput="updatePriceLabel(this.value)" />

                            <!-- Tooltip for displaying value -->
                            <div id="priceTooltip"
                                class="absolute left-0 px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 rounded opacity-0 -top-8 bg-primary">
                                Rp0
                            </div>
                        </div>
                        <p class="flex justify-between mt-2 text-sm">
                            <span>Rp0</span>
                            <span>Rp2.000.000</span>
                        </p>
                        <p class="hidden mt-2 text-sm">Selected Price: Rp<span
                                id="priceLabel">{{ request('price_range', 2000000) }}</span></p>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 text-white rounded-lg bg-primary">
                            Apply Price
                        </button>
                        <a href="{{ route('products') }}" class="px-4 py-2 text-black bg-gray-200 rounded-lg">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Products Section -->
            <div class="w-full md:w-3/4 md:ml-6">
                @if ($products->count() > 0)
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        @foreach ($products as $product)
                            <div class="flex flex-col bg-[#f7f7f7] rounded-b-lg">
                                <img src="{{ asset('storage/' . $product->image_url) }}" class="object-cover w-full"
                                    alt="Product Image">
                                <div class="flex flex-col gap-2 p-4">
                                    <div class="flex space-x-2">
                                        @foreach ($product->categories as $category)
                                            <span
                                                class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <p class="text-lg font-bold text-left truncate">{{ $product->title }}</p>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                                            </svg>
                                        @endfor
                                        <span class="text-sm text-gray-500">(5.0)</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between p-4">
                                    <p class="text-xl font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                    <button onclick="addToCart({{ $product->id }})"
                                        class="flex items-center justify-center w-8 h-8 text-white rounded-full bg-primary hover:bg-primary-dark">
                                        +
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        <div class="flex items-center justify-center gap-4">
                            {{-- Previous Page Link --}}
                            @if ($products->onFirstPage())
                                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}"
                                    class="px-4 py-2 rounded text-primary hover:text-white hover:bg-primary-light">Previous</a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $pageNumber => $url)
                                @if ($pageNumber == $products->currentPage())
                                    <span
                                        class="px-4 py-2 text-white rounded bg-primary hover:text-white">{{ $pageNumber }}</span>
                                @else
                                    <a href="{{ $url }}"
                                        class="px-4 py-2 rounded text-primary hover:text-white hover:bg-primary-light">{{ $pageNumber }}</a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}"
                                    class="px-4 py-2 rounded text-primary hover:text-white hover:bg-primary-light">Next</a>
                            @else
                                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Next</span>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="mt-12 text-center">
                        <p class="text-lg font-bold text-gray-600">No products found. Please adjust your filters.</p>
                    </div>
                @endif


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const rangeInput = document.getElementById('priceRange');
        const tooltip = document.getElementById('priceTooltip');

        function updatePriceLabel(value) {
            // Update label for max price
            document.getElementById('priceLabel').innerText = parseInt(value).toLocaleString('id-ID');
            // Update tooltip position and value
            const percent = (value - rangeInput.min) / (rangeInput.max - rangeInput.min) * 100;
            tooltip.style.left = `calc(${percent}% - 16px)`;
            tooltip.innerText = `Rp${parseInt(value).toLocaleString('id-ID')}`;
            tooltip.style.opacity = '1';
        }

        rangeInput.addEventListener('mousemove', (e) => {
            updatePriceLabel(rangeInput.value);
        });

        rangeInput.addEventListener('mouseleave', () => {
            tooltip.style.opacity = '0';
        });

        function addToCart(productId) {

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            if (!csrfToken) {
                Swal.fire('Error', 'CSRF token not found. Please refresh the page.', 'error');
                return;
            }

            Swal.fire({
                title: 'Rental Details',
                html: `
            <div class="space-y-4 text-left w-md">
                <div>
                    <label for="start_date" class="w-full mb-2 font-bold">Start Date</label>
                    <input type="datetime-local" id="start_date" class="max-w-xl p-2 border rounded swal2-input">
                </div>
                <div>
                    <label for="end_date" class="w-full mb-2 font-bold">End Date</label>
                    <input type="datetime-local" id="end_date" class="max-w-xl p-2 border rounded swal2-input">
                </div>
                <div>
                    <label for="quantity" class="w-full mb-2 font-bold">Quantity</label>
                    <input type="number" id="quantity" class="max-w-xl p-2 border rounded swal2-input" min="1" value="1">
                </div>
            </div>
        `,
                showCancelButton: true,
                confirmButtonText: 'Add to Cart',
                confirmButtonColor: '#1D4ED8', // primary color
                cancelButtonText: 'Cancel',
                cancelButtonColor: '#EF4444', // red color
                preConfirm: () => {
                    const startDate = document.getElementById('start_date').value;
                    const endDate = document.getElementById('end_date').value;
                    const quantity = document.getElementById('quantity').value;

                    return fetch('/cart/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                start_date: startDate,
                                end_date: endDate,
                                quantity: quantity
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
                    Swal.fire('Added to cart!', '', 'success');
                }
            });
        }
    </script>

@endsection
