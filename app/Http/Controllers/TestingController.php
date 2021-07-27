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

        $search = "admin";
        // $search = "";
        $limit = 10;
        $start = 0;
        $dir = 'ASC';

        /**
         * QUERY BUILDER TEST
         */

        $getUsers = User::leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as rolename')->whereDoesntHave('roles', function ($query) {
                $query->where('roles.name', 'admin');
            })->where('roles.name', 'LIKE', "%{$search}%");



        /**
         * ELOQUENT TEST
         */

        // $getUsers = User::with('roles:name')->whereDoesntHave('roles', function ($query) use ($dir) {
        //     return $query->where('name', 'super admin')->orderBy('name', $dir);
        // });



        // tidak bekerja dengan baik
        // $getUsers = User::with(['roles' => function ($q) use ($search) {
        //     $q->select('name')->whereNotIn('name', ['super admin']);
        // }]);

        // $getUsers = User::with(['roles' => function ($q) use ($search) {
        //     $q->select('name')->where('name', 'LIKE', "%{$search}%");
        // }])->whereDoesntHave('roles', function ($query) {
        //     $query->where('name', 'super admin');
        // });

        // $getUsers = User::with('roles:name')->whereDoesntHave('roles', function ($query) use ($search) {
        //     $query->where('name', 'super admin');
        // });


        // $getUsers = User::with('roles:name');

        //on search
        // $getUsers->where(function ($query) use ($search) {
        //     $query->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('username', 'LIKE', "%{$search}%")
        //         ->orWhere('email', 'LIKE', "%{$search}%");
        // });
        // $getUsers->whereHas('roles', function ($query) use ($search) {
        //     $query->where('name', 'LIKE', "%{$search}%");
        // })->where(function ($query) use ($search) {
        //     $query->where('name', 'LIKE', "%{$search}%")
        //         ->orWhere('username', 'LIKE', "%{$search}%")
        //         ->orWhere('email', 'LIKE', "%{$search}%");
        // });

        // $getUsers->where(function ($query) use ($search) {
        //     $query->where('roles.name', 'LIKE', "%{$search}%")
        //         ->orWhere('users.name', 'LIKE', "%{$search}%")
        //         ->orWhere('username', 'LIKE', "%{$search}%")
        //         ->orWhere('email', 'LIKE', "%{$search}%");
        // });

        //get order
        $users = $getUsers->offset($start)
            ->limit($limit)
            // ->orderBy('roles.name', $dir)
            ->orderBy('id', $dir)
            ->get();

        $dataJson = [
            'totalFiltered' => $getUsers->count(),
            'data' => $users
        ];
        // dd($users);

        return response()->json($dataJson);
    }
}
