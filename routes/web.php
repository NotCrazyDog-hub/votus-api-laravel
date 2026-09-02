<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExplanationController;
use App\Http\Controllers\Admin\ExplanationController as AdminExplanationController;
use App\Http\Controllers\Admin\TrustedSourceController;
use App\Http\Controllers\OpportunityController;

use App\Http\Controllers\PublicOpportunityController;
use App\Http\Controllers\Admin\PublicOpportunityController as AdminPublicOpportunityController;

use App\Http\Controllers\Api\LocationController;

use App\Http\Controllers\UniversityController;
use App\Http\Controllers\CourseOfferingController;

// UNIVERSIDADE

Route::get(
    '/cursos/{courseOffering}',
    [CourseOfferingController::class, 'show']
)->name('course-offerings.show');

Route::get(
    '/universidades',
    [UniversityController::class, 'index']
)->name('universities.index');

Route::get(
    '/universidades/opcoes/municipios',
    [UniversityController::class, 'municipalities']
)->name('universities.options.municipalities');

Route::get(
    '/universidades/opcoes/cursos',
    [UniversityController::class, 'courses']
)->name('universities.options.courses');

Route::get(
    '/universidades/{university}',
    [UniversityController::class, 'show']
)->name('universities.show');


// Página inicial
Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get(
        '/explicacoes',
        [AdminExplanationController::class, 'index']
    )->name('explanations.index');


    Route::get(
        '/explicacoes/criar',
        [AdminExplanationController::class, 'create']
    )->name('explanations.create');


    Route::post(
        '/explicacoes/gerar',
        [AdminExplanationController::class, 'generate']
    )->name('explanations.generate');


    Route::get(
        '/explicacoes/{explanation}/editar',
        [AdminExplanationController::class, 'edit']
    )->name('explanations.edit');


    Route::put(
        '/explicacoes/{explanation}',
        [AdminExplanationController::class, 'update']
    )->name('explanations.update');


    Route::post(
        '/explicacoes/{explanation}/publicar',
        [AdminExplanationController::class, 'publish']
    )->name('explanations.publish');

    Route::patch(
        '/explicacoes/{explanation}/ocultar',
        [AdminExplanationController::class, 'unpublish']
    )->name('explanations.unpublish');

    Route::delete(
        '/explicacoes/{explanation}',
        [AdminExplanationController::class, 'destroy']
    )->name('explanations.destroy');

    Route::post(
        '/fontes',
        [TrustedSourceController::class, 'store']
    )->name('sources.store');


    Route::put(
        '/fontes/{trustedSource}',
        [TrustedSourceController::class, 'update']
    )->name('sources.update');

    Route::delete(
        '/fontes/{trustedSource}',
        [TrustedSourceController::class, 'destroy']
    )->name('sources.destroy');

    // CONCURSOS PÚBLICOS

    Route::get(
        '/oportunidades-publicas',
        [AdminPublicOpportunityController::class, 'index']
    )->name('public-opportunities.index');

    Route::get(
        '/oportunidades-publicas/{opportunity}/editar',
        [AdminPublicOpportunityController::class, 'edit']
    )->name('public-opportunities.edit');

    Route::put(
        '/oportunidades-publicas/{opportunity}',
        [AdminPublicOpportunityController::class, 'update']
    )->name('public-opportunities.update');

    Route::post(
        '/oportunidades-publicas/{opportunity}/publicar',
        [AdminPublicOpportunityController::class, 'approve']
    )->name('public-opportunities.approve');

    Route::post(
        '/oportunidades-publicas/{opportunity}/descartar',
        [AdminPublicOpportunityController::class, 'reject']
    )->name('public-opportunities.reject');

    Route::patch(
        '/oportunidades-publicas/{opportunity}/toggle-published',
        [AdminPublicOpportunityController::class, 'togglePublished']
    )->name('public-opportunities.toggle-published');

});


Route::get(
    '/explicacoes',
    [ExplanationController::class, 'index']
)->name('explanations.index');


Route::get(
    '/explicacoes/{explanation}',
    [ExplanationController::class, 'show']
)->name('explanations.show');

Route::get(
    '/oportunidades', 
    [OpportunityController::class, 'index']
)->name('opportunities.index');


// CONCURSOS PÚBLICOS

Route::get(
    '/oportunidades-publicas',
    [PublicOpportunityController::class, 'index']
)->name('public-opportunities.index');

Route::get(
    '/oportunidades-publicas/{opportunity}',
    [PublicOpportunityController::class, 'show']
)->name('public-opportunities.show');

// LOCALIZAÇÃOS ROTAS

Route::get('/locations/states', [
    LocationController::class,
    'states',
]);

Route::get('/locations/states/{stateId}/cities', [
    LocationController::class,
    'cities',
]);