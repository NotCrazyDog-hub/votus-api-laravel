<?php

namespace App\Http\Controllers;

use App\Models\Explanation;

class ExplanationController extends Controller
{
    public function index()
    {
        $explanations =
            Explanation::query()
                ->where(
                    'status',
                    'published'
                )
                ->latest(
                    'published_at'
                )
                ->paginate(12);

        return view(
            'explanations.index',
            compact('explanations')
        );
    }

    public function show(
        Explanation $explanation
    ) {
        abort_unless(
            $explanation->status
                === 'published',
            404
        );

        $explanation->load([
            'sources',
            'quizQuestions.options',
        ]);

        return view(
            'explanations.show',
            compact('explanation')
        );
    }
}