<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    // protected $table = 'packages';
    public function places(){
        return $this->belongsToMany(Place::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
