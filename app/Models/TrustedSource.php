<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrustedSource extends Model
{
    protected $fillable = [
        'name',
        'domain',
        'base_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}