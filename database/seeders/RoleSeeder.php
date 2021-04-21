<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'super admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'operator crypto',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'operator wo',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'operator car wash',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'operator health care',
            'guard_name' => 'web'
        ]);
    }
}
