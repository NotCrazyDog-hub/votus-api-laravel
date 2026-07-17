<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::command('sync:legislators-lower-house')->everyEightDays();
Schedule::command('sync:legislators-senate')->everyEightDays();
