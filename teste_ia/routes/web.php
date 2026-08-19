<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgenteController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::view('/', 'home')->name('home');

Route::post('/agente/perguntar', [AgenteController::class, 'perguntar'])
->middleware('throttle:10,1')
->name('agente.perguntar');