<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('sync:legislators-lower-house')->everyFiveMinutes()->withoutOverlapping();
Schedule::command('sync:committees-lower-house')->everyFiveMinutes()->withoutOverlapping();
Schedule::command('sync:bills-lower-house')->everyFiveMinutes()->withoutOverlapping();
Schedule::command('sync:legislators-senate')->everyFiveMinutes()->withoutOverlapping();
Schedule::command('sync:committees-senate')->everyFiveMinutes()->withoutOverlapping();
Schedule::command('sync:bills-senate')->everyFiveMinutes()->withoutOverlapping();