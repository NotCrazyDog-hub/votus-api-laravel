<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LegislatorService;
use App\Models\Legislator;

class LegislatorController extends Controller
{
    public function __construct(protected LegislatorService $service) {}
    
    public function indexForDeputies(Request $request)
    {
        return response()->json(
            $this->service->listByChamber('lower_house', $request->state)
        );
    }

    public function indexForSenators(Request $request)
    {
        return response()->json(
            $this->service->listByChamber('senate', $request->state)
        );
    }

    public function showDeputy(int $external_id)
    {
        return response()->json(
            $this->service->findByChamber($external_id, 'lower_house')
        );
    }

    public function showSenator(int $external_id)
    {
        return response()->json(
            $this->service->findByChamber($external_id, 'senate')
        );
    }
}