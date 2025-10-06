<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $cast = [
         'created_at'                        => 'datetime',
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)
            ->timezone('Asia/Riyadh') // لضبط التوقيت
            ->format('d/m/Y'); // تنسيق السعودية
    }
    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
