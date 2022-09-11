<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => "Create Dashboard",
                'slug' => 'create-dashboard',
                'module_id' => 1
            ],
            [
                'id' => 2,
                'name' => "Update Dashboard",
                'slug' => 'update-dashboard',
                'module_id' => 1
            ],
            [
                'id' => 3,
                'name' => "Read Dashboard",
                'slug' => 'read-dashboard',
                'module_id' => 1
            ],
            [
                'id' => 4,
                'name' => "Delete Dashboard",
                'slug' => 'delete-dashboard',
                'module_id' => 1
            ],
            [
                'id' => 5,
                'name' => "Create Users",
                'slug' => 'create-users',
                'module_id' => 2
            ],
            [
                'id' => 6,
                'name' => "Update Users",
                'slug' => 'update-users',
                'module_id' => 2
            ],
            [
                'id' => 7,
                'name' => "Read Users",
                'slug' => 'read-users',
                'module_id' => 2
            ],
            [
                'id' => 8,
                'name' => "Delete Users",
                'slug' => 'delete-users',
                'module_id' => 2
            ],
            [
                'id' => 9,
                'name' => "Create Roles",
                'slug' => 'create-roles',
                'module_id' => 3
            ],
            [
                'id' => 10,
                'name' => "Update Roles",
                'slug' => 'update-roles',
                'module_id' => 3
            ],
            [
                'id' => 11,
                'name' => "Read Roles",
                'slug' => 'read-roles',
                'module_id' => 3
            ],
            [
                'id' => 12,
                'name' => "Delete Roles",
                'slug' => 'delete-roles',
                'module_id' => 3
            ],
            [
                'id' => 13,
                'name' => "Create Permissions",
                'slug' => 'create-permissions',
                'module_id' => 4
            ],
            [
                'id' => 14,
                'name' => "Update Permissions",
                'slug' => 'update-permissions',
                'module_id' => 4
            ],
            [
                'id' => 15,
                'name' => "Read Permissions",
                'slug' => 'read-permissions',
                'module_id' => 4
            ],
            [
                'id' => 16,
                'name' => "Delete Permissions",
                'slug' => 'delete-permissions',
                'module_id' => 4
            ],
            [
                'id' => 17,
                'name' => "Create Modules",
                'slug' => 'create-modules',
                'module_id' => 5
            ],
            [
                'id' => 18,
                'name' => "Update Modules",
                'slug' => 'update-modules',
                'module_id' => 5
            ],
            [
                'id' => 19,
                'name' => "Read Modules",
                'slug' => 'read-modules',
                'module_id' => 5
            ],
            [
                'id' => 20,
                'name' => "Delete Modules",
                'slug' => 'delete-modules',
                'module_id' => 5
            ],
            [
                'id' => 21,
                'name' => "Create Restaurants",
                'slug' => 'create-restaurants',
                'module_id' => 6
            ],
            [
                'id' => 22,
                'name' => "Update Restaurants",
                'slug' => 'update-restaurants',
                'module_id' => 6
            ],
            [
                'id' => 23,
                'name' => "Read Restaurants",
                'slug' => 'read-restaurants',
                'module_id' => 6
            ],
            [
                'id' => 24,
                'name' => "Delete Restaurants",
                'slug' => 'delete-restaurants',
                'module_id' => 6
            ],
        ]);
    }
}
