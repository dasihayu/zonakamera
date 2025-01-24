<!-- Hero Section -->
<div class="relative">
    <!-- Background Image -->
    <img src="{{ asset('storage/' . $page->home_banner_img) }}" alt="Hero Image" class="w-full h-screen object-cover blur-sm" />


    <!-- Headline -->
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
        <h1 class="text-6xl font-extrabold md:text-8xl max-w-4xl drop-shadow-lg text-white">
            {{ $page->home_banner_title}}
        </h1>
        <p class="mt-4 text-2xl md:text-3xl text-white">
            {{ $page->home_banner_sub }}
        </p>
        <a href="{{ route('products') }}"
            class="flex items-center text-2xl bg-primary text-white py-2 px-6 rounded hover:bg-primary-dark transition mt-6">
            <span>Book Now</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>
