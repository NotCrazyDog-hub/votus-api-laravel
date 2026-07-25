<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LegislatorController;
use App\Http\Controllers\SchedulerController;

Route::middleware('throttle:api')->group(function () 
{
    Route::get('/deputies', [LegislatorController::class, 'indexForDeputies']);
    Route::get('/deputies/{external_id}', [LegislatorController::class, 'showDeputy']);
    Route::get('/senators', [LegislatorController::class, 'indexForSenators']);
    Route::get('/senators/{external_id}', [LegislatorController::class, 'showSenator']);
});

Route::get('/schedule/run', [SchedulerController::class, 'run']);