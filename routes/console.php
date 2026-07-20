<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('sync:legislators-lower-house')->cron('0 0 */8 * *');
Schedule::command('sync:legislators-senate')->cron('0 0 */8 * *');