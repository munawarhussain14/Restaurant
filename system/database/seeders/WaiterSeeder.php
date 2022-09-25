<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class WaiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert(
            [
                "id"   => 7,
                'name' => "Waiters",
                'slug' => 'waiter',
        ]);

        DB::table('permissions')->insert([
            [
                'id' => 25,
                'name' => "Create Waiter",
                'slug' => 'create-waiter',
                'module_id' => 7
            ],
            [
                'id' => 26,
                'name' => "Update Waiter",
                'slug' => 'update-waiter',
                'module_id' => 7
            ],
            [
                'id' => 27,
                'name' => "Read Waiter",
                'slug' => 'read-waiter',
                'module_id' => 7
            ],
            [
                'id' => 28,
                'name' => "Delete Waiter",
                'slug' => 'delete-waiter',
                'module_id' => 7
            ]
        ]);

        DB::table('roles_permissions')->insert([
            [
                'role_id' => 1,
                'permission_id' => 25,
            ],
            [
                'role_id' => 1,
                'permission_id' => 26,
            ],
            [
                'role_id' => 1,
                'permission_id' => 27,
            ],
            [
                'role_id' => 1,
                'permission_id' => 28,
            ],
            [
                'role_id' => 2,
                'permission_id' => 25,
            ],
            [
                'role_id' => 2,
                'permission_id' => 26,
            ],
            [
                'role_id' => 2,
                'permission_id' => 27,
            ],
            [
                'role_id' => 2,
                'permission_id' => 28,
            ]
        ]
        );
    }
}
