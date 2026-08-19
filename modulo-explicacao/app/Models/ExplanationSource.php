<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExplanationSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'explanation_id',
        'source_name',
        'source_url',
        'source_domain',
    ];

    public function explanation()
    {
        return $this->belongsTo(Explanation::class);
    }
}