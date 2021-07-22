<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
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
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        $permissions = [
            'user create', 'user read', 'user update', 'user delete',
            'post create', 'post read', 'post update', 'post delete',
            'category create', 'category read', 'category update', 'category delete',
            'tag create', 'tag read', 'tag update', 'tag delete',
            'page create', 'page read', 'page update', 'page delete',
            'plugin create', 'plugin read', 'plugin update', 'plugin delete',
            'component create', 'component read', 'component update', 'component delete',
            'model create', 'model read', 'model update', 'model delete',
            'view create', 'view read', 'view update', 'view delete',
            'resource create', 'resource read', 'resource update', 'resource delete',
        ];

        foreach ($permissions as $permit) {
            Permission::create([
                'name' => $permit,
                'guard_name' => "web"
            ]);
        }

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

        $user = User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => "user@user.com",
            'password' => bcrypt('password')
        ]);

        $user->assignRole('user');




        //** give role permissions */
        $roleSuper = Role::find(1);

        $roleSuper->syncPermissions([
            'user create', 'user read', 'user update', 'user delete'
        ]);

        $roleAdmin = Role::find(2);

        $roleAdmin->syncPermissions([
            'user create', 'user read', 'user update'
        ]);

        $roleUser = Role::find(3);

        $roleUser->syncPermissions([
            'user create', 'user read'
        ]);
    }
}
