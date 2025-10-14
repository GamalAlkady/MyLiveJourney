<?php

namespace App\Models;

use jeremykenedy\LaravelRoles\Models\Role as OriginRole;

class Role extends OriginRole
{
    //

   protected static function booted()
    {
        // parent::boot();

        // static::addGlobalScope('notAdmin', function ($query) {
        //     return $query->where('slug','!=', 'admin');
        // });
    }

    public function scopeWithoutAdmin($query){
        return $query->where('slug','!=', 'admin');
    }

    public function getPermissionsAttribute($value)
    {
        return json_decode($value, true);
    }
}
