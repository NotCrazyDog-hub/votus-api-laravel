<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('sync:legislators-lower-house')->everyMinute();
Schedule::command('sync:committees-lower-house')->everyMinute();
Schedule::command('sync:bills-lower-house')->everyMinute();
Schedule::command('sync:legislators-senate')->everyMinute();
Schedule::command('sync:committees-senate')->everyMinute();
Schedule::command('sync:bills-senate')->everyMinute();