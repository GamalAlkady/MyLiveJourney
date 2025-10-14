<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\TourStatus;
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
        'status'
    ];

    protected $casts = [
        'status' => TourStatus::class,
    ];

    public function isAvailable()
    {
        return $this->remaining_seats > 0 ;
    }

    /**
     * Check if the tour is full.
     *
     * @return bool
     */
    public function isFull()
    {
        // if the booked seats is equal or greater than the max seats, then the tour is full
        return $this->remaining_seats==0;
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

    /** 
     * * ****************************************************************  Scopes 
     */

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query,$search)
    {
        if(empty($search)) return $query;
        return $query->where('title', 'LIKE', '%' . $search . '%');
    }

     /** 
     * * **************************************************************** Functions 
     */ 
    public function approvedBookings()
    {
        return $this->bookings()->where('status', BookingStatus::Approved->value);
    }

    public function pendingBookings()
    {
        return $this->bookings()->where('status', BookingStatus::Pending->value);
    }

    public function getPendingSeatsCountAttribute()
    {
        return $this->bookings()
            ->where('status', BookingStatus::Pending->value)
            ->sum('seats');
    }
}
