<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'user_id', 
        'price',
        'start_date', 
        'end_date'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'booking_product')
            ->where('is_visible', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
