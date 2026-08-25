<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'noticias';

    protected $fillable = [
        'titulo',
        'resumo_original',
        'resumo_ia',
        'url',
        'fonte',
        'categoria',
        'data_publicacao',
        'data_importacao',
        'score_relevancia',
        'palavras_chave',
        'publicar',
    ];

    protected $casts = [
        'palavras_chave' => 'array',
        'data_publicacao' => 'datetime',
        'data_importacao' => 'datetime',
        'publicar' => 'boolean',
    ];
}