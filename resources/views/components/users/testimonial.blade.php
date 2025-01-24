<!-- Testimonial Section -->
<div class="w-full my-24 bg-[#F7F7F7] mx-auto p-6">
    <p class="text-primary text-center">TESTIMONIALS</p>
    <h2 class="text-5xl font-bold text-center mb-12">Our Client Reviews</h2>

    <!-- Swiper -->
    <div class="swiper testimonial-swiper">
        <div class="swiper-wrapper">
            <?php
            // Testimonial data array
            $testimonials = [
                [
                    'name' => 'John Doe',
                    'role' => 'Professional Photographer',
                    'testimonial' => 'The equipment quality is exceptional, and the service is top-notch. I\'ve been renting gear for my professional shoots here for the past year, and I couldn\'t be happier with the experience.',
                    'rating' => 5
                ],
                [
                    'name' => 'Jane Doe',
                    'role' => 'Professional Videographer',
                    'testimonial' => 'Absolutely loved the gear I rented! The service was excellent, and I had everything I needed for my shoot. Highly recommend it.',
                    'rating' => 4
                ],
                [
                    'name' => 'Chandra Liow',
                    'role' => 'Professional Filmmaker',
                    'testimonial' => 'I\'ve been using this service for months, and it has always been reliable. The equipment is top-notch, and the support team is very helpful.',
                    'rating' => 5
                ],
                [
                    'name' => 'Sarah Lee',
                    'role' => 'Event Planner',
                    'testimonial' => 'The gear is perfect for every event I work on. The rental process is seamless, and I always get great service!',
                    'rating' => 4
                ],
                [
                    'name' => 'Michael Brown',
                    'role' => 'Director',
                    'testimonial' => 'A fantastic experience every time. The quality of the equipment is unmatched, and I feel confident using it for my film shoots.',
                    'rating' => 5
                ],
                [
                    'name' => 'Emily Clark',
                    'role' => 'Creative Director',
                    'testimonial' => 'Every piece of equipment I rented here has been in pristine condition. This is my go-to rental service.',
                    'rating' => 5
                ],
                [
                    'name' => 'Daniel Kim',
                    'role' => 'Photographer',
                    'testimonial' => 'Quick, reliable, and affordable. I always find the best equipment for my photo shoots here.',
                    'rating' => 4
                ],
                [
                    'name' => 'Rachel Adams',
                    'role' => 'Cinematographer',
                    'testimonial' => 'The rental service saved me a lot of time and money. The quality of the gear is excellent, and the support team is always available.',
                    'rating' => 4
                ],
                [
                    'name' => 'James Wilson',
                    'role' => 'Producer',
                    'testimonial' => 'I always rely on this service for all my shoots. The team is professional, and the equipment is always in great condition.',
                    'rating' => 5
                ],
                [
                    'name' => 'Olivia Harris',
                    'role' => 'Video Editor',
                    'testimonial' => 'I rented equipment for a big shoot, and everything went smoothly. Great service, highly recommend!',
                    'rating' => 5
                ]
            ];

            // Loop through testimonials and display each one
            foreach ($testimonials as $testimonial) {
                echo '<div class="swiper-slide p-8">
                        <div class="bg-white rounded-lg p-8 shadow-lg">
                            <div class="flex justify-center items-center mb-4">
                                <div>
                                    <h4 class="font-bold text-xl text-center">' . $testimonial['name'] . '</h4>
                                    <p class="text-gray-600 text-center">' . $testimonial['role'] . '</p>
                                </div>
                            </div>
                            <p class="text-gray-700 text-center">"' . $testimonial['testimonial'] . '"</p>
                            <div class="flex justify-center items-center m-4">
                                ' . generateRatingStars($testimonial['rating']) . '
                            </div>
                        </div>
                    </div>';
            }

            // Function to generate rating stars
            function generateRatingStars($rating) {
                $stars = '';
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $rating) {
                        $stars .= '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                                    </svg>';
                    } else {
                        $stars .= '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400/20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 .587l3.668 7.431 8.2 1.191-5.934 5.786 1.4 8.164L12 18.897l-7.334 3.862 1.4-8.164L.132 9.209l8.2-1.191L12 .587z" />
                                    </svg>';
                    }
                }
                return $stars;
            }
            ?>
        </div>
    </div>
</div>
