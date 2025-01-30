<!-- Hero Section -->
<div class="relative">
    <!-- Background Image -->
    <img src="{{ asset('storage/' . $page->home_banner_img) }}" alt="Hero Image" class="object-cover w-full h-screen blur-sm" />

    <!-- Headline -->
    <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center">
        <h1 class="max-w-4xl text-4xl font-extrabold leading-tight text-white md:text-6xl lg:text-8xl drop-shadow-lg">
            {{ $page->home_banner_title}}
        </h1>
        <p class="mt-4 text-lg text-white md:text-2xl lg:text-3xl">
            {{ $page->home_banner_sub }}
        </p>
        <a href="{{ route('products') }}"
            class="flex items-center px-4 py-2 mt-6 text-xl text-white transition rounded md:text-2xl bg-primary md:px-6 hover:bg-primary-dark">
            <span>Book Now</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>