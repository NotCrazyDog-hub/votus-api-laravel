<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegislatorController;

Route::get('/deputies', [LegislatorController::class, 'indexForDeputies']);
Route::get('/senators', [LegislatorController::class, 'indexForSenators']);
Route::get('/legislators/{legislator}', [LegislatorController::class, 'show']);