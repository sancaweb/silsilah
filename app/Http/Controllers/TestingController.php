<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class TestingController extends Controller
{
    public function index()
    {
        auth()->user()->id;
        // dd($users);
    }
}
