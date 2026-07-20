<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('sync:legislators-lower-house')->weekly();
Schedule::command('sync:legislators-senate')->weekly();