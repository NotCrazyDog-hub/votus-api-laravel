<?php

namespace App\Http\Controllers;

use App\Models\Legislator;
use Illuminate\Http\Request;

class LegislatorController extends Controller
{
    public function indexForDeputies(Request $request)
    {
        return response()->json(
            Legislator::where('chamber', 'lower_house')
                ->when($request->state, fn ($q, $uf) => $q->where('state', $uf))
                ->paginate(50)
        );
    }

    public function indexForSenators(Request $request)
    {
        return response()->json(
            Legislator::where('chamber', 'senate')
                ->when($request->state, fn ($q, $uf) => $q->where('state', $uf))
                ->paginate(50)
        );
    }

    public function show(Legislator $legislator)
    {
        return response()->json($legislator);
    }
}