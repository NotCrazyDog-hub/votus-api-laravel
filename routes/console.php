<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('sync:legislators-lower-house')->weekly();
Schedule::command('sync:committees-lower-house')->weekly();
Schedule::command('sync:legislators-senate')->weekly();
Schedule::command('sync:committees-senate')->weekly();
Schedule::command('sync:bills-lower-house')->weekly();
Schedule::command('sync:bills-senate')->weekly();