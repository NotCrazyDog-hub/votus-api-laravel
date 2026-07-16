<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegislatorController extends Controller
{
    public function indexForDeputies() {
        return response()->json();
    }

    public function indexForSenators() {
        return response()->json();
    }

    public function show() {
        return response()->json();
    }
}
