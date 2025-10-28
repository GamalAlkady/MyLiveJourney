<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\TourStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tours';

    protected $fillable = [
        'title',
        'description',
        'price',
        'start_date',
        'end_date',
        'max_seats',
        'booked_seats',
        'remaining_seats',
        'place_id',
        'guide_id',
        'status',
    ];

    protected $casts = [
        'status' => TourStatus::class,
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function isAvailable()
    {
        // Carbon::diffForHumans();
        return $this->remaining_seats > 0;
    }

    /**
     * Check if the tour is full.
     *
     * @return bool
     */
    public function isFull()
    {
        // if the booked seats is equal or greater than the max seats, then the tour is full
        return $this->remaining_seats == 0;
    }

    // ✅ خاصية: الفرق بين التاريخين بالأيام
    public function getDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            return $this->end_date->diffInDays($this->start_date);
        }

        return null;
    }

    // ✅ خاصية: الفرق بين التاريخين بالساعات والدقائق بطريقة بشرية
    public function getHumanDateAttribute()
    {
        if ($this->start_date && $this->end_date) {
            return $this->end_date->diffForHumans($this->start_date, [
                'parts' => 3, // عدد الأجزاء (مثلاً: "2 أيام و3 ساعات")
                'join' => true,
            ]);
        }

        return null;
    }

    // ✅ خاصية: إظهار التاريخين مع الوقت بصيغة جميلة
    public function getStartDateFormattedAttribute()
    {
        return $this->start_date?->format('Y-m-d h:i A');
    }

    public function getEndDateFormattedAttribute()
    {
        return $this->end_date?->format('Y-m-d h:i A');
    }

    // get start date only
    public function getStartDateOnlyAttribute()
    {
        return $this->start_date?->format('Y-m-d');
    }
    public function getEndDateOnlyAttribute()
    {
        return $this->end_date?->format('Y-m-d');
    }

    public function getStartTimeAttribute()
    {
        return $this->start_date?->format('h:i A');
    }

    public function getEndTimeAttribute()
    {
        return $this->end_date?->format('h:i A');
    }

    /**
     * * **************************************************************** Relations
     * Get the places that the tour belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function places()
    {
        return $this->belongsToMany(Place::class);
    }

    public function tourists()
    {
        return $this->belongsToMany(User::class, 'bookings')
            ->withPivot('status')
            ->withTimestamps();
    }

    /**
     * Get the guide that owns the Tour.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id', 'id');
    }

    // public function tourist()
    // {
    //     $this->belongsTo(User::class, 'tourist_id');
    // }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function chatRoom()
    {
        return $this->hasOne(ChatRoom::class);
    }

    /**
     * * ****************************************************************  Scopes
     */

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where('title', 'LIKE', '%'.$search.'%');
    }

    /**
     * * **************************************************************** Functions
     */
    public function approvedBookings()
    {
        return $this->bookings()->where('status', BookingStatus::APPROVED->value);
    }

    public function pendingBookings()
    {
        return $this->bookings()->where('status', BookingStatus::PENDING->value);
    }

    public function getPendingSeatsCountAttribute()
    {
        return $this->bookings()
            ->where('status', BookingStatus::PENDING->value)
            ->sum('seats');
    }
}
