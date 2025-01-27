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
        Schema::table('booking_product', function (Blueprint $table) {
            $table->integer('quantity');
            $table->decimal('price', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_product', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('price');
        });
    }
};
