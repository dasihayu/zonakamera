<!-- Instagram Video Section -->
<div class="container mx-auto my-24">
    <h2 class="text-5xl font-bold text-center mb-12">Follow Our Instagram</h2>

    <!-- Swiper -->
    <div class="swiper video-swiper">
        <div class="swiper-wrapper">
            <?php
            // Video data array
            $videos = [
                [
                    'title' => 'Behind the Scenes of Our Latest Shoot',
                    'description' => 'Get a sneak peek at the magic behind our recent project.',
                    'video_src' => asset('video/1730094710411936.mp4')
                ],
                [
                    'title' => 'Exploring New Locations for Projects',
                    'description' => 'Watch us scout new, exciting locations for future shoots.',
                    'video_src' => asset('video/1730094772313968.mp4')
                ],
                [
                    'title' => 'Client Testimonial: A Successful Project',
                    'description' => 'See what our client has to say about working with us.',
                    'video_src' => asset('video/1735801316233281.mp4')
                ],
                [
                    'title' => 'Creative Process: From Concept to Reality',
                    'description' => 'See how we turn ideas into visual masterpieces.',
                    'video_src' => asset('video/1735801374043962.mp4')
                ],
                [
                    'title' => 'Lighting Setup for Night Shoots',
                    'description' => 'Learn the tricks we use to get the perfect lighting for night shoots.',
                    'video_src' => asset('video/1735801417271336.mp4')
                ],
                [
                    'title' => 'Post-Production: Editing Magic',
                    'description' => 'Take a look at the editing process that brings our projects to life.',
                    'video_src' => asset('video/1735801556537191.mp4')
                ],
                [
                    'title' => 'A Day on Set: Team Collaboration',
                    'description' => 'Watch how our team collaborates on set to make every shoot successful.',
                    'video_src' => asset('video/1735801652680801.mp4')
                ],
                [
                    'title' => 'The Art of Cinematic Storytelling',
                    'description' => 'Discover how we craft compelling stories through film.',
                    'video_src' => asset('video/1735801871542604.mp4')
                ]
            ];

            // Loop through videos and display each one
            foreach ($videos as $video) {
                echo '<div class="swiper-slide relative group">
                        <video class="w-full h-128 object-cover rounded-lg" muted>
                            <source src="' . $video['video_src'] . '" type="video/mp4">
                        </video>
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-white p-4 rounded-lg">
                            <h3 class="text-xl font-bold mb-2 text-center">' . $video['title'] . '</h3>
                            <p class="text-sm text-center">' . $video['description'] . '</p>
                        </div>
                    </div>';
            }
            ?>
        </div>

        <!-- Navigation Buttons -->
        <div class="swiper-button-next text-primary"></div>
        <div class="swiper-button-prev text-primary"></div>
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>
