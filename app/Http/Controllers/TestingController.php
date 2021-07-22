<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;

class TestingController extends Controller
{
    public function index()
    {
        $countPermissions = Permission::count();

        $pembagian = $countPermissions / 2;

        $startSatu = 0;
        // $limit = $pembagian;
        $startDua = $pembagian;

        $pembagianSatu = Permission::offset($startSatu)->limit($pembagian)->get();
        $pembagianDua = Permission::offset($startDua)->limit($pembagian)->get();

        dd($pembagianDua);
    }
}
