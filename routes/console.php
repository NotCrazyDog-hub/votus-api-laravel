<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::command('sync:legislators-lower-house')->everyDays(8);
Schedule::command('sync:legislators-senate')->everyDays(8);
