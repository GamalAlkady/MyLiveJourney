<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('permission_role')->truncate();
        // DB::table('permissions')->truncate();
        /*
         * Permission Types
         *
         */
        $Permissionitems = [
            // View User
            [
                'name'        => 'View Users',
                'slug'        => 'view.users',
                'description' => 'Can view users',
                'model'       => 'App\Models\User',
            ],
            // Create User
            [
                'name'        => 'Create Users',
                'slug'        => 'create.users',
                'description' => 'Can create new users',
                'model'       => 'App\Models\User',
            ],
            // Update User
            [
                'name'        => 'Update Users',
                'slug'        => 'update.users',
                'description' => 'Can update users',
                'model'       => 'App\Models\User',
            ],
            // Delete User
            [
                'name'        => 'Delete Users',
                'slug'        => 'delete.users',
                'description' => 'Can delete users',
                'model'       => 'App\Models\User',
            ],
            // View District
            [
                'name'        => 'View Districts',
                'slug'        => 'view.districts',
                'description' => 'Can view districts',
                'model'       => 'App\Models\District',
            ],
            // Create District
            [
                'name'        => 'Create Districts',
                'slug'        => 'create.districts',
                'description' => 'Can create new districts',
                'model'       => 'App\Models\District',
            ],
            // Update District
            [
                'name'        => 'Update Districts',
                'slug'        => 'update.districts',
                'description' => 'Can update districts',
                'model'       => 'App\Models\District',
            ],
            // Delete District
            [
                'name'        => 'Delete Districts',
                'slug'        => 'delete.districts',
                'description' => 'Can delete districts',
                'model'       => 'App\Models\District',
            ],
            // View Place Type
            [
                'name'        => 'View Place Types',
                'slug'        => 'view.placetypes',
                'description' => 'Can view place types',
                'model'       => 'App\Models\PlaceType',
            ],
            // Create Place Type
            [
                'name'        => 'Create Place Types',
                'slug'        => 'create.placetypes',
                'description' => 'Can create new place types',
                'model'       => 'App\Models\PlaceType',
            ],
            // Update Place Type
            [
                'name'        => 'Update Place Types',
                'slug'        => 'update.placetypes',
                'description' => 'Can update place types',
                'model'       => 'App\Models\PlaceType',
            ],
            // Delete Place Type
            [
                'name'        => 'Delete Place Types',
                'slug'        => 'delete.placetypes',
                'description' => 'Can delete place types',
                'model'       => 'App\Models\PlaceType',
            ],
            // View Place
            [
                'name'        => 'View Places',
                'slug'        => 'view.places',
                'description' => 'Can view places',
                'model'       => 'App\Models\Place',
            ],
            // Create Place
            [
                'name'        => 'Create Places',
                'slug'        => 'create.places',
                'description' => 'Can create new places',
                'model'       => 'App\Models\Place',
            ],
            // Update Place
            [
                'name'        => 'Update Places',
                'slug'        => 'update.places',
                'description' => 'Can update places',
                'model'       => 'App\Models\Place',
            ],
            // Delete Place
            [
                'name'        => 'Delete Places',
                'slug'        => 'delete.places',
                'description' => 'Can delete places',
                'model'       => 'App\Models\Place',
            ],
            // View Tours
            [
                'name'        => 'View Tours',
                'slug'        => 'view.tours',
                'description' => 'Can view tours',
                'model'       => 'App\Models\Tour',
            ],
            // Create Tours
            [
                'name'        => 'Create Tours',
                'slug'        => 'create.tours',
                'description' => 'Can create new tours',
                'model'       => 'App\Models\Tour',
            ],
            // Update Tours
            [
                'name'        => 'Update Tours',
                'slug'        => 'update.tours',
                'description' => 'Can update tours',
                'model'       => 'App\Models\Tour',
            ],
            // Delete Tours
            [
                'name'        => 'Delete Tours',
                'slug'        => 'delete.tours',
                'description' => 'Can delete tours',
                'model'       => 'App\Models\Tour',
            ],

        ];



        /*
         * Create Permission Items
         *
         */
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = Permission::where('slug', '=', $Permissionitem['slug'])->first();
            if (null === $newPermissionitem) {
                $newPermissionitem = Permission::create([
                    'name'        => $Permissionitem['name'],
                    'slug'        => $Permissionitem['slug'],
                    'description' => $Permissionitem['description'],
                    'model'       => $Permissionitem['model'],
                ]);
            }
        }

    }
}
