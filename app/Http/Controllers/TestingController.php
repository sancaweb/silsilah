<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class TestingController extends Controller
{
    public function index()
    {
        $users = User::onlyTrashed()->find(20);

        if ($users) {
            dd("Data ditemukan");
        } else {
            dd("Data tidak ditemukan");
        }

        // dd($users);
    }
}
