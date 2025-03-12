<!-- Products Section -->
<div class="flex flex-col items-center justify-center px-4 mx-auto my-8 text-center bg-white md:my-12 md:px-6">
    <h1 class="text-3xl font-bold md:text-5xl">Best Selling Product</h1>
    <!--- Product Carousel --->
    <div class="grid w-3/4 grid-cols-1 mt-8 sm:grid-cols-2 lg:grid-cols-4 md:mt-12">
        @foreach ($products as $product)
            <div class="flex flex-col bg-white rounded-lg shadow-md mx-auto w-full max-w-[300px]">
                <img src="{{ asset('storage/' . $product->image_url) }}" class="object-cover w-full h-48 rounded-t-lg"
                    alt="">
                <div class="flex flex-col gap-2 p-4">
                    <div class="flex flex-wrap gap-2">
                        @foreach ($product->categories as $category)
                            <span
                                class="px-2 py-1 text-xs bg-blue-100 border rounded-full text-primary border-primary-light">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                    <p class="text-xl font-bold text-left truncate md:text-2xl">{{ $product->title }}</p>
                    <div class="flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                            </svg>
                        @endfor
                        <span class="text-sm text-gray-500">(5.0)</span>
                    </div>
                </div>
                <div class="flex items-center justify-between p-4">
                    @if (auth()->user()?->is_member)
                        <div class="flex flex-col items-start gap-1">
                            <span class="text-gray-500 line-through">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-lg text-primary">
                                    Rp{{ number_format($product->getPriceForUser(auth()->user()), 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @else
                        <span class="font-bold text-lg text-primary">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    @endif
                    <a href="{{ route('products') }}"
                        class="flex items-center justify-center w-8 h-8 text-white rounded-full bg-primary hover:bg-primary-dark">
                        +
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <a href="{{ route('products') }}" class="mt-8 md:mt-12">
        <div class="flex flex-row items-center justify-center gap-1 hover:border-b-2 hover:border-primary">
            <p class="text-primary">View More</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 text-primary" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </div>
    </a>
</div>
