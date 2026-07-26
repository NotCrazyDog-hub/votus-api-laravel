<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegislatorController;
use App\Http\Controllers\SchedulerController;

Route::get('/deputies', [LegislatorController::class, 'indexForDeputies']);
Route::get('/deputies/{external_id}', [LegislatorController::class, 'showDeputy']);
Route::get('/senators', [LegislatorController::class, 'indexForSenators']);
Route::get('/senators/{external_id}', [LegislatorController::class, 'showSenator']);

Route::get('/schedule/run/{token}', [SchedulerController::class, 'run']);
Route::get('/sync/run/{command}/{token}', [SchedulerController::class, 'runSingle']);