<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Explanation;
use App\Models\TrustedSource;
use App\Services\N8nContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;
use Illuminate\Support\Facades\Log;

class ExplanationController extends Controller
{
    public function index()
    {
        $explanations = Explanation::query()
            ->latest()
            ->paginate(20);

        $trustedSources = TrustedSource::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.explanations.index',
            compact(
                'explanations',
                'trustedSources'
            )
        );
    }

    public function create()
    {
        return view(
            'admin.explanations.create'
        );
    }

    public function generate(
        Request $request,
        N8nContentService $n8n
    ) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'question_title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
        ]);

        $allowedDomains = TrustedSource::query()
            ->where('is_active', true)
            ->pluck('domain')
            ->values()
            ->all();

        if (empty($allowedDomains)) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Nenhuma fonte confiável está cadastrada.'
                );
        }

        try {
            $result = $n8n->generate([
                'title' => $validated['title'],
                'question_title' => $validated['question_title'],
                'category' => $validated['category'],
                'allowed_domains' => $allowedDomains,
            ]);

            $this->validateN8nResult($result);

            $explanation = DB::transaction(function () use ($validated, $result) {
                return $this->saveGeneratedContent($validated, $result);
            });

            return redirect()
                ->route('admin.explanations.edit', $explanation)
                ->with(
                    'success',
                    'Conteúdo gerado com sucesso. Revise antes de publicar.'
                );
        } catch (Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Não foi possível gerar o conteúdo: ' . $exception->getMessage()
                );
        }
    }

    private function validateN8nResult(
        array $result
    ): void {

        if (!isset($result['explanation'])) {
            throw new \RuntimeException(
                'A explicação não foi retornada.'
            );
        }

        if (
            empty($result['sources'])
            || !is_array($result['sources'])
        ) {
            throw new \RuntimeException(
                'Nenhuma fonte foi retornada.'
            );
        }

        if (
            !isset($result['quiz'])
            || count($result['quiz']) !== 5
        ) {
            throw new \RuntimeException(
                'O quiz deve possuir 5 perguntas.'
            );
        }

        foreach ($result['quiz'] as $question) {

            if (
                !isset($question['options'])
                || count($question['options']) !== 4
            ) {
                throw new \RuntimeException(
                    'Cada pergunta deve possuir 4 alternativas.'
                );
            }

            $correct = collect(
                $question['options']
            )->where(
                'correct',
                true
            )->count();

            if ($correct !== 1) {
                throw new \RuntimeException(
                    'Cada pergunta deve possuir '
                    . 'exatamente uma resposta correta.'
                );
            }
        }
    }

    private function saveGeneratedContent(
        array $input,
        array $result
    ): Explanation {

        $generated = $result['explanation'];

        $slug = Str::slug(
            $input['title']
        );

        if (
            Explanation::where(
                'slug',
                $slug
            )->exists()
        ) {
            $slug .= '-'
                . Str::lower(
                    Str::random(6)
                );
        }

        $explanation = Explanation::create([
            'title' =>
                $input['title'],

            'slug' =>
                $slug,

            'question_title' =>
                $input['question_title'],

            'category' =>
                $input['category'],

            'summary' =>
                $generated['summary'],

            'what_is' =>
                $generated['what_is'],

            'purpose' =>
                $generated['purpose'],

            'practical_role' =>
                $generated['practical_role'],

            'why_it_matters' =>
                $generated['why_it_matters'],

            'citizen_impact' =>
                $generated['citizen_impact'],

            'example' =>
                $generated['example'],

            'status' =>
                'review',

            'content_version' =>
                1,
        ]);

        foreach (
            $result['sources']
            as $source
        ) {

            $explanation
                ->sources()
                ->create([
                    'source_name' =>
                        $source['name'],

                    'source_url' =>
                        $source['url'],

                    'source_domain' =>
                        $source['domain'],
                ]);
        }

        foreach (
            $result['quiz']
            as $questionIndex =>
            $questionData
        ) {

            $question =
                $explanation
                    ->quizQuestions()
                    ->create([
                        'question' =>
                            $questionData[
                                'question'
                            ],

                        'explanation' =>
                            $questionData[
                                'explanation'
                            ],

                        'position' =>
                            $questionIndex + 1,

                        'based_on_content_version'
                            => 1,
                    ]);

            foreach (
                $questionData['options']
                as $optionIndex =>
                $optionData
            ) {

                $question
                    ->options()
                    ->create([
                        'option_text' =>
                            $optionData['text'],

                        'is_correct' =>
                            $optionData['correct'],

                        'position' =>
                            $optionIndex + 1,
                    ]);
            }
        }

        return $explanation;
    }

    public function edit(
        Explanation $explanation
    ) {
        $explanation->load([
            'sources',
            'quizQuestions.options',
        ]);

        return view(
            'admin.explanations.edit',
            compact('explanation')
        );
    }

    public function update(
        Request $request,
        Explanation $explanation
    ) {
        $validated = $request->validate([
            'title' =>
                ['required', 'string', 'max:255'],

            'question_title' =>
                ['required', 'string', 'max:255'],

            'category' =>
                ['required', 'string', 'max:255'],

            'summary' =>
                ['required', 'string'],

            'what_is' =>
                ['required', 'string'],

            'purpose' =>
                ['required', 'string'],

            'practical_role' =>
                ['required', 'string'],

            'why_it_matters' =>
                ['required', 'string'],

            'citizen_impact' =>
                ['required', 'string'],

            'example' =>
                ['required', 'string'],

            'quiz' =>
                ['required', 'array', 'size:5'],

            'quiz.*.question' =>
                ['required', 'string'],

            'quiz.*.explanation' =>
                ['required', 'string'],

            'quiz.*.correct_option' =>
                ['required', 'integer'],

            'quiz.*.options' =>
                ['required', 'array', 'size:4'],

            'quiz.*.options.*' =>
                ['required', 'string'],
        ]);

        DB::transaction(
            function () use (
                $validated,
                $explanation
            ) {

                $version =
                    $explanation->content_version
                    + 1;

                $explanation->update([
                    'title' =>
                        $validated['title'],

                    'question_title' =>
                        $validated['question_title'],

                    'category' =>
                        $validated['category'],

                    'summary' =>
                        $validated['summary'],

                    'what_is' =>
                        $validated['what_is'],

                    'purpose' =>
                        $validated['purpose'],

                    'practical_role' =>
                        $validated['practical_role'],

                    'why_it_matters' =>
                        $validated['why_it_matters'],

                    'citizen_impact' =>
                        $validated['citizen_impact'],

                    'example' =>
                        $validated['example'],

                    'content_version' =>
                        $version,

                    'status' =>
                        'review',
                ]);

                foreach (
                    $validated['quiz']
                    as $questionId =>
                    $questionData
                ) {

                    $question =
                        $explanation
                            ->quizQuestions()
                            ->findOrFail(
                                $questionId
                            );

                    $question->update([
                        'question' =>
                            $questionData['question'],

                        'explanation' =>
                            $questionData['explanation'],

                        'based_on_content_version'
                            => $version,
                    ]);

                    foreach (
                        $questionData['options']
                        as $optionId =>
                        $optionText
                    ) {

                        $option =
                            $question
                                ->options()
                                ->findOrFail(
                                    $optionId
                                );

                        $option->update([
                            'option_text' =>
                                $optionText,

                            'is_correct' =>
                                (int) $optionId
                                ===
                                (int) $questionData[
                                    'correct_option'
                                ],
                        ]);
                    }
                }
            }
        );

        return redirect()
            ->route(
                'admin.explanations.edit',
                $explanation
            )
            ->with(
                'success',
                'Alterações salvas.'
            );
    }

    public function publish(
        Explanation $explanation
    ) {
        $explanation->load([
            'sources',
            'quizQuestions.options',
        ]);

        if (
            $explanation->sources->isEmpty()
        ) {
            return back()->with(
                'error',
                'A publicação precisa possuir fontes.'
            );
        }

        if (
            $explanation
                ->quizQuestions
                ->count() !== 5
        ) {
            return back()->with(
                'error',
                'O quiz precisa possuir 5 perguntas.'
            );
        }

        foreach (
            $explanation->quizQuestions
            as $question
        ) {

            if (
                $question->options->count()
                !== 4
            ) {
                return back()->with(
                    'error',
                    'Cada pergunta precisa '
                    . 'possuir 4 alternativas.'
                );
            }

            if (
                $question
                    ->options
                    ->where(
                        'is_correct',
                        true
                    )
                    ->count() !== 1
            ) {
                return back()->with(
                    'error',
                    'Cada pergunta deve possuir '
                    . 'uma resposta correta.'
                );
            }
        }

        $explanation->update([
            'status' =>
                'published',

            'published_at' =>
                now(),
        ]);

        return redirect()
            ->route(
                'admin.explanations.index'
            )
            ->with(
                'success',
                'Conteúdo publicado.'
            );
    }

    public function unpublish(
        Explanation $explanation
    ) {
        $explanation->update([
            'status' => 'review',
            'published_at' => null,
        ]);

        return redirect()
            ->route('admin.explanations.index')
            ->with(
                'success',
                'A explicação foi removida da área pública.'
            );
    }

    public function destroy(
        Explanation $explanation
    ) {
        DB::transaction(function () use ($explanation) {

            $explanation->load([
                'sources',
                'quizQuestions.options',
            ]);

            foreach ($explanation->quizQuestions as $question) {

                $question->options()->delete();

                $question->delete();
            }

            $explanation->sources()->delete();

            $explanation->delete();
        });

        return redirect()
            ->route('admin.explanations.index')
            ->with(
                'success',
                'A explicação foi apagada definitivamente.'
            );
    }

}