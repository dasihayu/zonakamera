@extends('layouts.layout')

@section('title', 'Product')

@section('content')

    <div class="flex flex-col items-center justify-center my-12 p-6 w-full">
        <div class="flex flex-col md:flex-row w-full max-w-screen-lg">
            <!-- Sidebar Filter -->
            <div class="w-full md:w-1/4 p-4 bg-gray-100 rounded-lg">
                <form action="{{ route('products') }}" method="GET">
                    <!-- Search -->
                    <div class="mb-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search products..." class="w-full border border-gray-300 rounded-lg px-4 py-2" />
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-4">
                        <p class="font-bold mb-2">Categories</p>
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
                        <p class="font-bold mb-2">Price Range</p>
                        <div class="relative">
                            <!-- Price Range Slider -->
                            <input type="range" name="price_range" id="priceRange" min="0" max="2000000"
                                step="50000" value="{{ request('price_range', 2000000) }}" class="w-full cursor-pointer"
                                oninput="updatePriceLabel(this.value)" />

                            <!-- Tooltip for displaying value -->
                            <div id="priceTooltip"
                                class="absolute -top-8 left-0 bg-primary text-white text-xs rounded px-2 py-1 transform -translate-x-1/2 opacity-0 transition-opacity">
                                Rp0
                            </div>
                        </div>
                        <p class="text-sm mt-2 flex justify-between">
                            <span>Rp0</span>
                            <span>Rp2.000.000</span>
                        </p>
                        <p class="text-sm mt-2 hidden">Selected Price: Rp<span
                                id="priceLabel">{{ request('price_range', 2000000) }}</span></p>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">
                            Apply Price
                        </button>
                        <a href="{{ route('products') }}" class="px-4 py-2 bg-gray-200 text-black rounded-lg">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Products Section -->
            <div class="w-full md:w-3/4 md:ml-6">
                @if ($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <div class="flex flex-col bg-[#f7f7f7] rounded-b-lg">
                                <img src="{{ asset('storage/' . $product->image_url) }}" class="w-full  object-cover"
                                    alt="Product Image">
                                <div class="p-4 flex flex-col gap-2">
                                    <div class="flex space-x-2">
                                        @foreach ($product->categories as $category)
                                            <span
                                                class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <p class="font-bold text-lg text-left truncate">{{ $product->title }}</p>
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
                                <div class="flex justify-between items-center p-4">
                                    <p class="font-bold text-xl">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                    <button
                                        class="w-8 h-8 flex items-center justify-center rounded-full bg-primary text-white hover:bg-primary-dark">+</button>
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
                                    class="px-4 py-2 text-primary hover:text-white hover:bg-primary-light rounded">Previous</a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $pageNumber => $url)
                                @if ($pageNumber == $products->currentPage())
                                    <span
                                        class="px-4 py-2 bg-primary hover:text-white text-white rounded">{{ $pageNumber }}</span>
                                @else
                                    <a href="{{ $url }}"
                                        class="px-4 py-2 text-primary hover:text-white hover:bg-primary-light rounded">{{ $pageNumber }}</a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}"
                                    class="px-4 py-2 text-primary hover:text-white hover:bg-primary-light rounded">Next</a>
                            @else
                                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Next</span>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-center mt-12">
                        <p class="text-lg font-bold text-gray-600">No products found. Please adjust your filters.</p>
                    </div>
                @endif


            </div>
        </div>
    </div>

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
    </script>

@endsection
