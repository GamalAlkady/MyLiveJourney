<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'id'           =>1,
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ],
            [
                'id'           =>2,
                'name'        => 'User',
                'slug'        => 'user',
                'description' => 'User Role',
                'level'       => 0,
            ],
            [
                'id'           =>3,
                'name'        => 'Guide',
                'slug'        => 'guide',
                'description' => 'Guide Role',
                'level'       => 3,
            ],
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = Role::where('slug', '=', $RoleItem['slug'])->first();
            if (null === $newRoleItem) {
                $newRoleItem = Role::create([
                    'id'            =>$RoleItem['id'],
                    'name'        => $RoleItem['name'],
                    'slug'        => $RoleItem['slug'],
                    'description' => $RoleItem['description'],
                    'level'       => $RoleItem['level'],
                ]);
            }
        }
    }
}
