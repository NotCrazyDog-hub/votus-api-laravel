<?php

use Illuminate\Support\Facades\Schedule;

// O agendamento migrou para rotas HTTP individuais disparadas externamente
// pelo cron-job.org, já que o Render (plano free) não suporta cron nativo
// nem execução de comando único demorada dentro de uma única requisição.
// Ver SchedulerController e a tabela de rotas documentada no README.

// Schedule::command('sync:legislators-lower-house')->everyFiveMinutes()->withoutOverlapping(10);
// Schedule::command('sync:committees-lower-house')->everyFiveMinutes()->withoutOverlapping(10);
// Schedule::command('sync:bills-lower-house')->everyFiveMinutes()->withoutOverlapping(10);
// Schedule::command('sync:legislators-senate')->everyFiveMinutes()->withoutOverlapping(10);
// Schedule::command('sync:committees-senate')->everyFiveMinutes()->withoutOverlapping(10);
// Schedule::command('sync:bills-senate')->everyFiveMinutes()->withoutOverlapping(10);