<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegislatorController;

Route::get('/deputies', [LegislatorController::class, 'indexForDeputies']);
Route::post('/senators', [LegislatorController::class, 'indexForSenators']);
Route::put('/legislators/{legislator}', [LegislatorController::class, 'show']);