<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bill extends Model
{
    protected $fillable = [
        'external_id',
        'chamber',
        'legislator_id',
        'type',
        'summary',
        'presented_at',
        'raw_data',
    ];

    protected $casts = [
        'raw_data' => 'array',
        'presented_at' => 'date',
    ];

    public function legislators(): BelongsToMany
    {
        return $this->belongsToMany(Legislator::class, 'bill_legislator');
    }
}