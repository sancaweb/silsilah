<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'username' => 'super',
            'email' => "super@email.com",
            'password' => bcrypt('password')
        ]);

        $superAdmin->assignRole('super admin');

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => "admin@email.com",
            'password' => bcrypt('password')
        ]);

        $admin->assignRole('admin');
    }
}
