<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    public $incrementing = false; // مهم جدًا
    protected $keyType = 'string'; // لأن الـ id نصي

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $booking->id = self::generateReferenceCode();
        });
    }

    public static function generateReferenceCode()
    {
        do {
            // مثال على الكود: BK-20251011-AB123
            $code = 'BK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        } while (self::where('id', $code)->exists());

        return $code;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'tourist_id',
        'tour_id',
        'seats',
        'total_price',
        'status'
    ];

    protected $casts = [
        'status' => BookingStatus::class,
    ];

    //////////////////////////////////////////////////////////////////////// Scopes
    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('bookings.status', BookingStatus::Pending->value);
    }

    public function scopeApproved($query){
        return $query->where('bookings.status', BookingStatus::Approved->value);
    }
    //////////////////////////////////////////////////////////////////////// Relations
    public function tourist()
    {
        return $this->belongsTo(User::class, 'tourist_id');
    }


    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function guide()
    {
        return $this->tour->guide(); // indirect, لكن لا يمكن كتابتها كعلاقة Eloquent مباشرة
    }
}
