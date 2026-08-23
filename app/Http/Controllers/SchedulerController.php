<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SchedulerController extends Controller
{
    // private array $commands = [
    //     'deputies' => 'sync:legislators-lower-house',
    //     'senators' => 'sync:legislators-senate',
    //     'committees-deputies' => 'sync:committees-lower-house',
    //     'committees-senators' => 'sync:committees-senate',
    //     'bills-deputies' => 'sync:bills-lower-house',
    //     'bills-senators' => 'sync:bills-senate',
    // ];

    public function status()
    {
        return response()->json(['status' => 'alive']);
    }
}