<!-- Products Section -->
{{-- TODO: Make category function --}}
<div class="flex flex-col items-center justify-center text-center my-12 mx-auto bg-[#F7F7F7] p-6">
    <h1 class="font-bold text-5xl">Best Selling Product</h1>
    <ul>
        <li class="flex flex-row justify-center items-center gap-6 mt-6 bg-[#EEEEEE] rounded-full p-6">
            <a href="{{ route('home') }}"
                class="text-lg font-semibold text-gray-800 hover:text-gray-600  {{ Route::is('home') ? 'border-b-2 border-primary' : '' }}">
                Camera
            </a>
            <a href="{{ route('about') }}"
                class="text-lg font-semibold text-gray-800 hover:text-gray-600 {{ Route::is('about') ? 'border-b-2 border-primary' : '' }}">
                Lens
            </a>
            <a href="{{ route('products') }}"
                class="text-lg font-semibold text-gray-800 hover:text-gray-600 {{ Route::is('products') ? 'border-b-2 border-primary' : '' }}">
                Audio
            </a>
            <a href="{{ route('products') }}"
                class="text-lg font-semibold text-gray-800 hover:text-gray-600 {{ Route::is('products') ? 'border-b-2 border-primary' : '' }}">
                Stabilizer
            </a>
        </li>
    </ul>

    <!--- Product Carousel --->
    <div class="flex flex-row gap-6 mt-12">
        <div class="flex flex-col max-w-[256px] bg-white">
            <img src="{{ asset('images/a7iv.jpg') }}" width="256" alt="">
            <div class="p-4 flex flex-col gap-2">
                <div class="flex space-x-2">
                    <span class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Camera
                    </span>
                    <span class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Body
                    </span>
                </div>
                <p class="font-bold text-2xl text-left">
                    Sony A7IV
                </p>
                <!-- Bintang -->
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <span class="text-sm text-gray-500">(5.0)</span>
                </div>
            </div>
            <div class="flex justify-between items-center p-4">
                <p class="font-bold text-xl">Rp 150.000</p>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-full bg-primary text-white hover:bg-primary-dark">
                    +
                </button>
            </div>
        </div>
        <div class="flex flex-col max-w-[256px] bg-white">
            <img src="{{ asset('images/a7iv.jpg') }}" width="256" alt="">
            <div class="p-4 flex flex-col gap-2">
                <div class="flex space-x-2">
                    <span class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Camera
                    </span>
                    <span class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Body
                    </span>
                </div>
                <p class="font-bold text-2xl text-left">
                    Sony A7IV
                </p>
                <!-- Bintang -->
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <span class="text-sm text-gray-500">(5.0)</span>
                </div>
            </div>
            <div class="flex justify-between items-center p-4">
                <p class="font-bold text-xl">Rp 150.000</p>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-full bg-primary text-white hover:bg-primary-dark">
                    +
                </button>
            </div>
        </div>
        <div class="flex flex-col max-w-[256px] bg-white">
            <img src="{{ asset('images/a7iv.jpg') }}" width="256" alt="">
            <div class="p-4 flex flex-col gap-2">
                <div class="flex space-x-2">
                    <span
                        class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Camera
                    </span>
                    <span
                        class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Body
                    </span>
                </div>
                <p class="font-bold text-2xl text-left">
                    Sony A7IV
                </p>
                <!-- Bintang -->
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <span class="text-sm text-gray-500">(5.0)</span>
                </div>
            </div>
            <div class="flex justify-between items-center p-4">
                <p class="font-bold text-xl">Rp 150.000</p>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-full bg-primary text-white hover:bg-primary-dark">
                    +
                </button>
            </div>
        </div>
        <div class="flex flex-col max-w-[256px] bg-white">
            <img src="{{ asset('images/a7iv.jpg') }}" width="256" alt="">
            <div class="p-4 flex flex-col gap-2">
                <div class="flex space-x-2">
                    <span
                        class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Camera
                    </span>
                    <span
                        class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Body
                    </span>
                </div>
                <p class="font-bold text-2xl text-left">
                    Sony A7IV
                </p>
                <!-- Bintang -->
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <span class="text-sm text-gray-500">(5.0)</span>
                </div>
            </div>
            <div class="flex justify-between items-center p-4">
                <p class="font-bold text-xl">Rp 150.000</p>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-full bg-primary text-white hover:bg-primary-dark">
                    +
                </button>
            </div>
        </div>
        <div class="flex flex-col max-w-[256px] bg-white">
            <img src="{{ asset('images/a7iv.jpg') }}" width="256" alt="">
            <div class="p-4 flex flex-col gap-2">
                <div class="flex space-x-2">
                    <span
                        class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Camera
                    </span>
                    <span
                        class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Body
                    </span>
                </div>
                <p class="font-bold text-2xl text-left">
                    Sony A7IV
                </p>
                <!-- Bintang -->
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <span class="text-sm text-gray-500">(5.0)</span>
                </div>
            </div>
            <div class="flex justify-between items-center p-4">
                <p class="font-bold text-xl">Rp 150.000</p>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-full bg-primary text-white hover:bg-primary-dark">
                    +
                </button>
            </div>
        </div>
        <div class="flex flex-col max-w-[256px] bg-white">
            <img src="{{ asset('images/a7iv.jpg') }}" width="256" alt="">
            <div class="p-4 flex flex-col gap-2">
                <div class="flex space-x-2">
                    <span
                        class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Camera
                    </span>
                    <span
                        class="px-1 py-0.5 text-xs bg-blue-100 text-primary rounded-full border border-primary-light">
                        Body
                    </span>
                </div>
                <p class="font-bold text-2xl text-left">
                    Sony A7IV
                </p>
                <!-- Bintang -->
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                    </svg>
                    <span class="text-sm text-gray-500">(5.0)</span>
                </div>
            </div>
            <div class="flex justify-between items-center p-4">
                <p class="font-bold text-xl">Rp 150.000</p>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-full bg-primary text-white hover:bg-primary-dark">
                    +
                </button>
            </div>
        </div>
    </div>
    <a href="">
        <div class="flex flex-row justify-center items-center mt-12 gap-1 hover:border-b-2 hover:border-primary">
            <p class="text-primary">View More</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4 text-primary" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </div>
    </a>
</div>