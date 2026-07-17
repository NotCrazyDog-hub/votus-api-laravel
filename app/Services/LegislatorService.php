<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Legislator;

class LegislatorService
{
    public function listByChamber(string $chamber, ?string $state = null)
    {
        return Legislator::where('chamber', $chamber)
            ->when($state, fn ($q) => $q->where('state', $state))
            ->paginate(50);
    }

    public function findByChamber(int $external_id, string $chamber): Legislator
    {
        return Legislator::where('external_id', $external_id)
            ->where('chamber', $chamber)
            ->firstOrFail();
    }
}