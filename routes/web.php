<?php
use App\Models\News;

Route::get('/painel', function () {
    $noticias = News::where('publicar', true)
        ->orderBy('data_publicacao', 'desc')
        ->get();

    return view('painel', compact('noticias'));
});