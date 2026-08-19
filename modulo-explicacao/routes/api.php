<?php

use App\Http\Controllers\Api\PublicOpportunityImportController;
use Illuminate\Support\Facades\Route;

Route::post(
    '/public-opportunities/import',
    [PublicOpportunityImportController::class, 'store']
);
