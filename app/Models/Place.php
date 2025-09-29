<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function placetype(){
        return $this->belongsTo(Placetype::class);
    }

    /**
     * Get the district that owns the place.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district(){
        return $this->belongsTo(District::class);
    }

    public function tours(){
        return $this->belongsToMany(Tour::class);
    }
}
