<!-- Instagram Video Section -->
<div class="container px-4 mx-auto my-12 md:my-24">
    <h2 class="mb-8 text-3xl font-bold text-center md:mb-12 md:text-5xl">Follow Our Instagram</h2>

    <!-- Swiper -->
    <div class="swiper video-swiper">
        <div class="swiper-wrapper">
            @foreach ($videos as $video)
                <div class="relative swiper-slide group">
                    <a href="instagram.com/zonakamerasemarang">
                        <video class="object-cover w-full h-64 rounded-lg md:h-96 lg:h-128" muted>
                            <source src="{{ Storage::url($video->url) }}" type="video/mp4">
                        </video>
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-opacity duration-300 bg-black bg-opacity-50 rounded-lg opacity-0 group-hover:opacity-100">
                            <h3 class="mb-2 text-lg font-bold text-center md:text-xl">{{ $video->title }}</h3>
                            <p class="text-xs text-center md:text-sm">{{ $video->description }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Navigation Buttons -->
        <div class="hidden swiper-button-next text-primary md:flex"></div>
        <div class="hidden swiper-button-prev text-primary md:flex"></div>
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>