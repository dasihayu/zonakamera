<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('home_banner_img')->nullable();
            $table->string('home_banner_title')->nullable();
            $table->string('home_banner_sub')->nullable();
            $table->string('home_about_img')->nullable();
            $table->string('home_about_title')->nullable();
            $table->text('home_about_sub')->nullable();
            $table->string('about_banner')->nullable();
            $table->string('about_image')->nullable();
            $table->string('about_content_title')->nullable();
            $table->text('about_content_desctiption')->nullable();
            $table->string('about_map_title')->nullable();
            $table->text('about_map_text')->nullable();
            $table->string('product_banner')->nullable();
            $table->string('featured_banner')->nullable();
            $table->string('member_banner')->nullable();
            $table->string('info_banner')->nullable();
            $table->timestamps();
        });

        Schema::create('reviews',  function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('review');
            $table->integer('rating');
            $table->timestamps();
        });
        
        Schema::create('instagram_videos',  function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('url_instagram');
            $table->string('video');
            $table->boolean('is_active')->default(FALSE);
            $table->timestamps();
        });
        
        Schema::create('promos',  function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('image');
            $table->boolean('is_active')->default(FALSE);
            $table->timestamps();
        });
        
        Schema::create('infos',  function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->boolean('is_active')->default(FALSE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('instagram_videos');
        Schema::dropIfExists('promos');
        Schema::dropIfExists('infos');
    }
};
