<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class TestingController extends Controller
{
    public function index()
    {


        $activity = Activity::select('causer_id')->distinct()->get();
        dd($activity);
    }
}
