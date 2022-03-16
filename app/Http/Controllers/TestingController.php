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

        // $user = User::find(2);
        $user = auth()->user()->person;

        // $user = User::find(1)->person;
        // $person = $user->person;

        // $photo = $user->photo;

        // $takeImage = $user->takeImage();

        dd($user);
    }
}
