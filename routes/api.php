<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegislatorController;

Route::middleware('throttle:api')->group(function () 
{
    Route::get('/deputies', [LegislatorController::class, 'indexForDeputies']);
    Route::get('/deputies/{external_id}', [LegislatorController::class, 'showDeputy']);
    Route::get('/senators', [LegislatorController::class, 'indexForSenators']);
    Route::get('/senators/{external_id}', [LegislatorController::class, 'showSenator']);

    Route::get('/legislators', [LegislatorController::class, 'index']);
    Route::get('/legislators/{legislator}', [LegislatorController::class, 'show']);
});