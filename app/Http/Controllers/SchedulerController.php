<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SchedulerController extends Controller
{
    public function run(string $token)
    {
        if ($token !== config('app.scheduler_token')) {
            abort(403);
        }

        Artisan::call('schedule:run');

        return response()->json(['status' => 'scheduled tasks executed']);
    }
}