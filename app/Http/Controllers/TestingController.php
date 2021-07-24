<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;

class TestingController extends Controller
{
    public function index()
    {
        // $user = User::find(1);

        $isSuperAdmin = auth()->user()->can('user delete');
        // $user->permissions
        // if ($isSuperAdmin) {
        //     return "ini super admin";
        //     // return "bukan super admin";
        // } else {
        //     return "ini bukan super admin";
        //     // return "ini super admin";
        // }

        // $user = User::create([
        //     'name' => "Nama usernya",
        //     'foto' => null,
        //     'username' => "usernamenya",
        //     'email' => "emailnya@emailnya.com",
        //     'password' => Hash::make("password")
        // ]);

        // $user->assignRole('role asal aja');
        // $roles = Role::whereNotIn('name', ['super admin'])->pluck('name');


        dd(auth()->user()->can('user read'));
    }
}
