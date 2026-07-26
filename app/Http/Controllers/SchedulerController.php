<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SchedulerController extends Controller
{
    private const ALLOWED_COMMANDS = [
        'legislators-lower-house',
        'committees-lower-house',
        'legislators-senate',
        'committees-senate',
        'bills-lower-house',
        'bills-senate',
    ];

    // public function run(string $token)
    // {
    //     if ($token !== config('app.scheduler_token')) {
    //         abort(403);
    //     }

    //     Artisan::call('schedule:run');

    //     return response()->json(['status' => 'scheduled tasks executed']);
    // }

    public function runSingle(string $command, string $token)
    {
        if ($token !== config('app.scheduler_token')) {
            abort(403);
        }

        if (! in_array($command, self::ALLOWED_COMMANDS, true)) {
            abort(404);
        }

        $lockKey = "sync-lock:{$command}";

        if (Cache::has($lockKey)) {
            return response()->json(['status' => 'skipped', 'reason' => 'already running'], 409);
        }

        Cache::put($lockKey, true, now()->addMinutes(20));

        try {
            Artisan::call("sync:{$command}");

            return response()->json([
                'status' => 'executed',
                'command' => $command,
                'output' => Artisan::output(),
            ]);
        } finally {
            Cache::forget($lockKey);
        }
    }
}