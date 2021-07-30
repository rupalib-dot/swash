<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'role_name' => 'ROLE_ADMIN',
        ]); 
        Role::insert([
            'role_name' => 'ROLE_SUBADMIN',
        ]); 
        Role::insert([
            'role_name' => 'ROLE_USER',
        ]);
    }
}
