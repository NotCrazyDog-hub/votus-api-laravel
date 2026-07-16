<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\LegislatorStatus;
use App\Enums\ElectoralStatus;

class Legislator extends Model
{
    protected $fillable = [
        'external_id',
        'chamber',
        'civil_name',
        'parliamentary_name',
        'photo_url',
        'party',
        'state',
        'legislature',
        'electoral_status',
        'status',
        'phone',
        'email',
        'official_website',
        'social_media',
        'raw_data',
    ];

    protected $casts = [
        'social_media' => 'array',
        'raw_data' => 'array',
        'status' => LegislatorStatus::class,
        'electoral_status' => ElectoralStatus::class,
    ];
}
