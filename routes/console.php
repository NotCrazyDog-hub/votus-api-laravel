<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('sync:legislators-lower-house')->everyFiveMinutes();
Schedule::command('sync:committees-lower-house')->everyFiveMinutes();
Schedule::command('sync:bills-lower-house')->everyFiveMinutes();
Schedule::command('sync:legislators-senate')->everyFiveMinutes();
Schedule::command('sync:committees-senate')->everyFiveMinutes();
Schedule::command('sync:bills-senate')->everyFiveMinutes();