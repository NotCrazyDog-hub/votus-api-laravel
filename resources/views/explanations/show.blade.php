<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $explanation->title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

    <main class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">

        <article>

            <header class="mb-10">

                <a
                    href="{{ route('explanations.index') }}"
                    class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-slate-900"
                >
                    ← Voltar para explicações
                </a>

                <div class="mb-4">

                    <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                        {{ $explanation->category }}
                    </span>

                </div>

                <h1 class="max-w-3xl text-3xl font-bold leading-tight tracking-tight text-slate-900 sm:text-4xl">
                    {{ $explanation->question_title }}
                </h1>

            </header>


            <section class="mb-8 rounded-2xl border border-indigo-100 bg-indigo-50 p-6 sm:p-7">

                <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-indigo-600">
                    Resposta rápida
                </p>

                <p class="text-base font-medium leading-7 text-slate-800 sm:text-lg">
                    {{ $explanation->summary }}
                </p>

            </section>


            <div class="space-y-5">

                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="mb-3 text-xl font-semibold text-slate-900">
                        O que é?
                    </h2>

                    <p class="text-base leading-7 text-slate-600">
                        {{ $explanation->what_is }}
                    </p>

                </section>


                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="mb-3 text-xl font-semibold text-slate-900">
                        Para que serve?
                    </h2>

                    <p class="text-base leading-7 text-slate-600">
                        {{ $explanation->purpose }}
                    </p>

                </section>


                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="mb-3 text-xl font-semibold text-slate-900">
                        O que faz na prática?
                    </h2>

                    <p class="text-base leading-7 text-slate-600">
                        {{ $explanation->practical_role }}
                    </p>

                </section>


                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="mb-3 text-xl font-semibold text-slate-900">
                        Por que isso importa?
                    </h2>

                    <p class="text-base leading-7 text-slate-600">
                        {{ $explanation->why_it_matters }}
                    </p>

                </section>


                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="mb-3 text-xl font-semibold text-slate-900">
                        Como isso afeta você?
                    </h2>

                    <p class="text-base leading-7 text-slate-600">
                        {{ $explanation->citizen_impact }}
                    </p>

                </section>


                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <h2 class="mb-3 text-xl font-semibold text-slate-900">
                        Um exemplo
                    </h2>

                    <p class="text-base leading-7 text-slate-600">
                        {{ $explanation->example }}
                    </p>

                </section>

            </div>


            <section class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-5">

                    <h2 class="text-xl font-semibold text-slate-900">
                        Fontes
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Consulte as fontes utilizadas na elaboração deste conteúdo.
                    </p>

                </div>


                <div class="space-y-3">

                    @foreach ($explanation->sources as $source)

                        <a
                            href="{{ $source->source_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group flex items-center justify-between gap-4 rounded-xl border border-slate-200 px-4 py-3 transition hover:border-indigo-200 hover:bg-indigo-50/50"
                        >

                            <div class="min-w-0">

                                <p class="font-medium text-slate-800 group-hover:text-indigo-700">
                                    {{ $source->source_name }}
                                </p>

                                <p class="mt-0.5 truncate text-xs text-slate-500">
                                    {{ $source->source_domain }}
                                </p>

                            </div>

                            <span class="shrink-0 text-indigo-600">
                                ↗
                            </span>

                        </a>

                    @endforeach

                </div>

            </section>


            <section class="mt-12">

                <div class="mb-7">

                    <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                        Quiz
                    </p>

                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                        Teste o que você aprendeu
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Responda às perguntas e confira a explicação de cada resposta.
                    </p>

                </div>


                <div class="space-y-6">

                    @foreach ($explanation->quizQuestions as $question)

                        <div
                            data-quiz-question
                            class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
                        >

                            <div class="mb-5 flex items-start gap-4">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700">
                                    {{ $question->position }}
                                </div>

                                <h3 class="pt-1 text-lg font-semibold leading-7 text-slate-900">
                                    {{ $question->question }}
                                </h3>

                            </div>


                            <div class="space-y-3">

                                @foreach ($question->options as $option)

                                    <label
                                        data-option
                                        class="flex cursor-pointer items-start gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-indigo-300 hover:bg-indigo-50/40"
                                    >

                                        <input
                                            type="radio"
                                            name="question_{{ $question->id }}"
                                            data-correct="{{ $option->is_correct ? '1' : '0' }}"
                                            class="mt-0.5 h-4 w-4 shrink-0 border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                        >

                                        <span class="text-sm leading-6 text-slate-700">
                                            {{ $option->option_text }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>


                            <div class="mt-5 flex flex-col gap-4">

                                <button
                                    type="button"
                                    data-check
                                    class="inline-flex w-fit items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                                >
                                    Verificar resposta
                                </button>


                                <div
                                    data-feedback-box
                                    class="hidden rounded-xl border px-4 py-4"
                                >

                                    <p
                                        data-feedback-title
                                        class="font-semibold"
                                    ></p>

                                    <p
                                        data-feedback
                                        class="mt-1 text-sm leading-6"
                                    ></p>

                                </div>


                                <p
                                    data-explanation
                                    hidden
                                >
                                    {{ $question->explanation }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>


            <div class="mt-12 border-t border-slate-200 pt-8 text-center">

                <a
                    href="{{ route('explanations.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 transition hover:text-indigo-800"
                >
                    ← Ver outras explicações
                </a>

            </div>

        </article>

    </main>


    <script>
        document
            .querySelectorAll('[data-quiz-question]')
            .forEach(card => {

                const button =
                    card.querySelector('[data-check]');

                const feedbackBox =
                    card.querySelector('[data-feedback-box]');

                const feedbackTitle =
                    card.querySelector('[data-feedback-title]');

                const feedback =
                    card.querySelector('[data-feedback]');

                const explanation =
                    card
                        .querySelector('[data-explanation]')
                        .textContent
                        .trim();


                button.addEventListener('click', () => {

                    const selected =
                        card.querySelector(
                            'input[type="radio"]:checked'
                        );

                    card
                        .querySelectorAll('[data-option]')
                        .forEach(option => {

                            option.classList.remove(
                                'border-emerald-300',
                                'bg-emerald-50',
                                'border-red-300',
                                'bg-red-50'
                            );

                        });


                    feedbackBox.classList.remove(
                        'hidden',
                        'border-emerald-200',
                        'bg-emerald-50',
                        'text-emerald-800',
                        'border-red-200',
                        'bg-red-50',
                        'text-red-800',
                        'border-amber-200',
                        'bg-amber-50',
                        'text-amber-800'
                    );


                    if (!selected) {

                        feedbackBox.classList.add(
                            'border-amber-200',
                            'bg-amber-50',
                            'text-amber-800'
                        );

                        feedbackTitle.textContent =
                            'Selecione uma alternativa';

                        feedback.textContent =
                            'Escolha uma resposta antes de verificar.';

                        return;

                    }


                    const selectedOption =
                        selected.closest('[data-option]');

                    const correct =
                        selected.dataset.correct === '1';


                    if (correct) {

                        selectedOption.classList.add(
                            'border-emerald-300',
                            'bg-emerald-50'
                        );

                        feedbackBox.classList.add(
                            'border-emerald-200',
                            'bg-emerald-50',
                            'text-emerald-800'
                        );

                        feedbackTitle.textContent =
                            'Resposta correta!';

                        feedback.textContent =
                            explanation;

                    } else {

                        selectedOption.classList.add(
                            'border-red-300',
                            'bg-red-50'
                        );

                        feedbackBox.classList.add(
                            'border-red-200',
                            'bg-red-50',
                            'text-red-800'
                        );

                        feedbackTitle.textContent =
                            'Ainda não é essa.';

                        feedback.textContent =
                            explanation;

                    }

                });

            });
    </script>
</body>
</html>