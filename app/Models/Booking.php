<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_id',  // Tambahkan ke fillable
        'user_id',
        'price',
        'start_date',
        'end_date',
        'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            if (!$booking->booking_id) {
                $booking->booking_id = $booking->generateUniqueId();
            }
        });
    }

    public function generateUniqueId()
    {
        $datePart = now()->format('Ymd'); // Format tanggal: YYYYMMDD
        $randomPart = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT); // Random 5 digit
        $newId = "BKG-{$datePart}-{$randomPart}";

        while (static::where('booking_id', $newId)->exists()) {
            $randomPart = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $newId = "BKG-{$datePart}-{$randomPart}";
        }

        return $newId;
    }

    public function setProductDetailsAttribute($value)
    {
        $this->productDetails = $value;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'booking_product')
            ->where('is_visible', true)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function voucherUsage()
    {
        return $this->hasOne(VoucherUsage::class);
    }
}
