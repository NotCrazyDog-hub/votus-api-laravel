<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::post('/noticias', [NewsController::class, 'store']);
Route::get('/noticias', [NewsController::class, 'index']);
Route::get('/noticias/{noticia}', [NewsController::class, 'show']);