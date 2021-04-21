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

        $operator_crypto = User::create([
            'name' => 'Operator Crypto',
            'username' => 'operator crypto',
            'email' => "operator_crypto@email.com",
            'password' => bcrypt('password')
        ]);

        $operator_crypto->assignRole('operator crypto');

        $operator_wo = User::create([
            'name' => 'Operator Wedding Organizer',
            'username' => 'operator wo',
            'email' => "operator_wo@email.com",
            'password' => bcrypt('password')
        ]);

        $operator_wo->assignRole('operator wo');

        $operator_car_wash = User::create([
            'name' => 'Operator Car Wash',
            'username' => 'operator car wash',
            'email' => "operator_car_wash@email.com",
            'password' => bcrypt('password')
        ]);

        $operator_car_wash->assignRole('operator car wash');

        $operator_health_care = User::create([
            'name' => 'Operator Health Care',
            'username' => 'operator health care',
            'email' => "operator_health_care@email.com",
            'password' => bcrypt('password')
        ]);

        $operator_health_care->assignRole('operator health care');
    }
}
