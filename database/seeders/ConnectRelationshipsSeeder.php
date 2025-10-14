<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        /**
         * Get Available Permissions.
         */
        $permissions = Permission::all();

        /**
         * Attach Permissions to Roles.
         */
        $roleAdmin = Role::withoutGlobalScope('notAdmin')->where('name', '=', 'Admin')->first();
        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
        }

        $permissions = Permission::where('slug', 'like', 'view.%')
            ->orWhere('slug', 'like', '%.tours')
            ->get();

        $roleGuide = Role::where('slug', '=', 'guide')->first();
        $roleGuide->syncPermissions($permissions);

        // $permissions = Permission::where('slug', 'like', 'view.tours')->get();

        // $roleUser = Role::where('name', '=', 'User')->first();
        // $roleUser->syncPermissions($permissions); // تخصيص أذونات فارغة
    }
}
