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
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('info_banner');
            $table->dropColumn('featured_banner');
            $table->dropColumn('member_banner');
            $table->string('booking_banner')->nullable();
            $table->string('cart_banner')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('info_banner')->nullable();
            $table->string('featured_banner')->nullable();
            $table->string('member_banner')->nullable();
            $table->dropColumn('booking_banner');
            $table->dropColumn('cart_banner');
        });
    }
};
