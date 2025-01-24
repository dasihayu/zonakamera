<!-- About Section -->
<div class="flex flex-row items-center justify-evenly text-center my-24 py-6 pr-6">
    <img src="{{ asset('storage/' . $page->home_about_img) }}" width="600" alt="" class="rounded-xl">
    <div class="flex flex-col w-[500px] gap-2">
        <p class="text-primary text-left">ABOUT US</p>
        <h1 class="font-bold text-5xl text-left">{{ $page->home_about_title }}</h1>
        <p class="text-left">{{ $page->home_about_sub }}</p>
        <a href="{{ route('about') }}">
            <div class="flex flex-row items-center mt-12 gap-1">
                <p class="text-primary hover:border-b-2 hover:border-primary">More Info</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4 text-primary" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </div>
        </a>
    </div>
</div>
