<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'original_summary',
        'ai_summary',
        'url',
        'source',
        'category',
        'published_at',
        'imported_at',
        'relevance_score',
        'keywords',
        'published',
    ];

    protected $casts = [
        'keywords' => 'array',
        'published_at' => 'datetime',
        'imported_at' => 'datetime',
        'published' => 'boolean',
    ];
}