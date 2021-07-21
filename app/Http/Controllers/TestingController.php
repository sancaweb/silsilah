<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class TestingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $roles = $user->roles->pluck('name');
        dd($roles[0]);
    }
}
