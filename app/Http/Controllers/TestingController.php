<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Activitylog\Models\Activity;

class TestingController extends Controller
{
    public function index()
    {
        $role = Role::find(4);
        // // $role->givePermissionTo(['create user', 'read user', 'update user']);
        // // $role->givePermissionTo(['create user', 'read user', 'update user', 'delete user']);
        // $role->givePermissionTo(['create user', 'read user']);

        // $user = User::find(1);

        // // $permissions = $user->getAllPermissions()->pluck('name');
        // $permissions = $user->getPermissionsViaRoles()->pluck('name');

        // $roles = Role::with('permission')->get();

        $permission = $role->hasPermissionTo('read user');

        dd($permission);
    }
}
