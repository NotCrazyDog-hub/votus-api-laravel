<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SchedulerController extends Controller
{
    private array $commands = [
        'deputies' => 'sync:legislators-lower-house',
        'senators' => 'sync:legislators-senate',
        'committees-deputies' => 'sync:committees-lower-house',
        'committees-senators' => 'sync:committees-senate',
        'bills-deputies' => 'sync:bills-lower-house',
        'bills-senators' => 'sync:bills-senate',
    ];

    public function runCommand(string $token, string $command)
    {
        if ($token !== config('app.scheduler_token')) {
            abort(403);
        }

        if (! isset($this->commands[$command])) {
            abort(404);
        }

        $artisanCommand = $this->commands[$command];
        $logFile = storage_path("logs/schedule-{$command}.log");

        $shellCommand = sprintf(
            'nohup php artisan %s >> %s 2>&1 &',
            escapeshellarg($artisanCommand),
            escapeshellarg($logFile)
        );

        exec($shellCommand);

        return response()->json([
            'status' => 'started',
            'command' => $artisanCommand,
        ]);
    }

    public function runCommandDebug(string $token, string $command)
    {
        if ($token !== config('app.scheduler_token')) {
            abort(403);
        }

        if (! isset($this->commands[$command])) {
            abort(404);
        }

        $exitCode = Artisan::call($this->commands[$command]);

        return response()->json([
            'status' => $exitCode === 0 ? 'success' : 'failed',
            'command' => $this->commands[$command],
            'output' => Artisan::output(),
        ]);
    }

    public function ping()
    {
        return response()->json(['status' => 'alive']);
    }

    // public function run(string $token)
    // {
    //     if ($token !== config('app.scheduler_token')) {
    //         abort(403);
    //     }

    //     Artisan::call('schedule:run');

    //     return response()->json(['status' => 'scheduled tasks executed']);
    // }
}