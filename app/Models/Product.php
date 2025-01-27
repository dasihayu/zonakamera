<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'is_visible',
        'price',
        'description',
        'image_url'
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category', 'product_id', 'category_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
