<?php

namespace App\Models;

use jeremykenedy\LaravelRoles\Models\Role as OriginRole;

class Role extends OriginRole
{
    //


    public function getPermissionsAttribute($value)
    {
        return json_decode($value, true);
    }

    // Get roles without admin
    public static function getRolesWithoutAdmin()
    {
        return self::where('slug', '!=', 'admin')->get();
    }
}
