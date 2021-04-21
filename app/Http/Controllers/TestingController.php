<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index()
    {
        $user = User::find(1);

        $activity = $user->activities();
        dd($activity);
    }
}
