<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisar explicação</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="mb-8">
            <a
                href="{{ route('admin.explanations.index') }}"
                class="mb-5 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-slate-900"
            >
                ← Voltar para explicações
            </a>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                <div>
                    <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                        Administração
                    </p>

                    <h1 class="text-3xl font-bold tracking-tight">
                        Revisar explicação
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Revise o conteúdo gerado, as fontes e as questões
                        antes de disponibilizá-lo aos usuários.
                    </p>
                </div>

                <div>
                    @if ($explanation->status === 'published')

                        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1.5 text-sm font-semibold text-emerald-700">
                            Publicada
                        </span>

                    @elseif ($explanation->status === 'review')

                        <span class="inline-flex rounded-full bg-amber-100 px-3 py-1.5 text-sm font-semibold text-amber-700">
                            Em revisão
                        </span>

                    @else

                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1.5 text-sm font-semibold text-slate-600">
                            {{ $explanation->status }}
                        </span>

                    @endif
                </div>

            </div>
        </header>


        @if (session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4">

                <p class="mb-2 text-sm font-semibold text-red-800">
                    Verifique os campos abaixo:
                </p>

                <ul class="list-inside list-disc space-y-1 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        <form
            id="explanation-form"
            method="POST"
            action="{{ route('admin.explanations.update', $explanation) }}"
            class="space-y-8"
        >
            @csrf
            @method('PUT')


            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-semibold">
                        Informações gerais
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Informações utilizadas para identificar e apresentar
                        o conteúdo na plataforma.
                    </p>
                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">

                    <div class="md:col-span-2">

                        <label
                            for="title"
                            class="mb-1.5 block text-sm font-medium text-slate-700"
                        >
                            Título
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title', $explanation->title) }}"
                            required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>


                    <div class="md:col-span-2">

                        <label
                            for="question_title"
                            class="mb-1.5 block text-sm font-medium text-slate-700"
                        >
                            Pergunta de abertura
                        </label>

                        <input
                            id="question_title"
                            type="text"
                            name="question_title"
                            value="{{ old('question_title', $explanation->question_title) }}"
                            required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>


                    <div>

                        <label
                            for="category"
                            class="mb-1.5 block text-sm font-medium text-slate-700"
                        >
                            Categoria
                        </label>

                        <input
                            id="category"
                            type="text"
                            name="category"
                            value="{{ old('category', $explanation->category) }}"
                            required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>

                </div>
            </section>


            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-semibold">
                        Explicação
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Revise as partes do conteúdo geradas pela IA.
                    </p>
                </div>


                <div class="space-y-6 p-6">

                    <div>
                        <label
                            for="summary"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Resumo
                        </label>

                        <textarea
                            id="summary"
                            name="summary"
                            rows="4"
                            required
                            class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >{{ old('summary', $explanation->summary) }}</textarea>
                    </div>


                    <div>
                        <label
                            for="what_is"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            O que é?
                        </label>

                        <textarea
                            id="what_is"
                            name="what_is"
                            rows="5"
                            required
                            class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >{{ old('what_is', $explanation->what_is) }}</textarea>
                    </div>


                    <div>
                        <label
                            for="purpose"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Para que serve?
                        </label>

                        <textarea
                            id="purpose"
                            name="purpose"
                            rows="5"
                            required
                            class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >{{ old('purpose', $explanation->purpose) }}</textarea>
                    </div>


                    <div>
                        <label
                            for="practical_role"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            O que faz na prática?
                        </label>

                        <textarea
                            id="practical_role"
                            name="practical_role"
                            rows="5"
                            required
                            class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >{{ old('practical_role', $explanation->practical_role) }}</textarea>
                    </div>


                    <div>
                        <label
                            for="why_it_matters"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Por que isso importa?
                        </label>

                        <textarea
                            id="why_it_matters"
                            name="why_it_matters"
                            rows="5"
                            required
                            class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >{{ old('why_it_matters', $explanation->why_it_matters) }}</textarea>
                    </div>


                    <div>
                        <label
                            for="citizen_impact"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Como afeta o cidadão?
                        </label>

                        <textarea
                            id="citizen_impact"
                            name="citizen_impact"
                            rows="5"
                            required
                            class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >{{ old('citizen_impact', $explanation->citizen_impact) }}</textarea>
                    </div>


                    <div>
                        <label
                            for="example"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Exemplo
                        </label>

                        <textarea
                            id="example"
                            name="example"
                            rows="5"
                            required
                            class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >{{ old('example', $explanation->example) }}</textarea>
                    </div>

                </div>
            </section>


            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-semibold">
                        Fontes utilizadas
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Fontes consultadas durante a geração desta explicação.
                    </p>
                </div>


                <div class="p-6">

                    @forelse ($explanation->sources as $source)

                        <div class="border-b border-slate-100 py-4 first:pt-0 last:border-0 last:pb-0">

                            <p class="font-medium text-slate-800">
                                {{ $source->source_name }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $source->source_domain }}
                            </p>

                            <a
                                href="{{ $source->source_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-2 inline-block break-all text-sm font-medium text-indigo-600 hover:text-indigo-800 hover:underline"
                            >
                                {{ $source->source_url }}
                            </a>

                        </div>

                    @empty

                        <p class="text-sm text-slate-500">
                            Nenhuma fonte associada.
                        </p>

                    @endforelse

                </div>
            </section>


            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-semibold">
                        Quiz
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Revise as perguntas, alternativas e respostas corretas
                        antes da publicação.
                    </p>
                </div>


                <div class="space-y-6 p-6">

                    @foreach ($explanation->quizQuestions as $question)

                        <article class="rounded-xl border border-slate-200 bg-slate-50/60 p-5">

                            <div class="mb-5 flex items-center justify-between">

                                <h3 class="font-semibold text-slate-900">
                                    Pergunta {{ $question->position }}
                                </h3>

                                <span class="text-xs font-medium text-slate-400">
                                    {{ $question->options->count() }} alternativas
                                </span>

                            </div>


                            <div class="mb-5">

                                <label
                                    for="question-{{ $question->id }}"
                                    class="mb-1.5 block text-sm font-medium text-slate-700"
                                >
                                    Pergunta
                                </label>

                                <textarea
                                    id="question-{{ $question->id }}"
                                    name="quiz[{{ $question->id }}][question]"
                                    rows="3"
                                    required
                                    class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                                >{{ old(
                                    "quiz.{$question->id}.question",
                                    $question->question
                                ) }}</textarea>

                            </div>


                            <fieldset>

                                <legend class="mb-3 text-sm font-medium text-slate-700">
                                    Alternativas
                                </legend>

                                <div class="space-y-3">

                                    @foreach ($question->options as $option)

                                        <label class="flex items-center gap-3 rounded-lg border border-slate-200 bg-white p-3 transition hover:border-slate-300">

                                            <input
                                                type="radio"
                                                name="quiz[{{ $question->id }}][correct_option]"
                                                value="{{ $option->id }}"
                                                @checked(
                                                    old(
                                                        "quiz.{$question->id}.correct_option",
                                                        $question->options
                                                            ->firstWhere('is_correct', true)
                                                            ?->id
                                                    ) == $option->id
                                                )
                                                class="h-4 w-4 shrink-0 border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                            >

                                            <input
                                                type="text"
                                                name="quiz[{{ $question->id }}][options][{{ $option->id }}]"
                                                value="{{ old(
                                                    "quiz.{$question->id}.options.{$option->id}",
                                                    $option->option_text
                                                ) }}"
                                                required
                                                class="w-full border-0 bg-transparent p-0 text-sm text-slate-700 outline-none focus:ring-0"
                                            >

                                        </label>

                                    @endforeach

                                </div>

                                <p class="mt-2 text-xs text-slate-500">
                                    Selecione o círculo ao lado da alternativa correta.
                                </p>

                            </fieldset>


                            <div class="mt-5">

                                <label
                                    for="explanation-{{ $question->id }}"
                                    class="mb-1.5 block text-sm font-medium text-slate-700"
                                >
                                    Explicação da resposta
                                </label>

                                <textarea
                                    id="explanation-{{ $question->id }}"
                                    name="quiz[{{ $question->id }}][explanation]"
                                    rows="3"
                                    required
                                    class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm leading-6 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                                >{{ old(
                                    "quiz.{$question->id}.explanation",
                                    $question->explanation
                                ) }}</textarea>

                            </div>

                        </article>

                    @endforeach

                </div>
            </section>


            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('admin.explanations.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800"
                >
                    Salvar alterações
                </button>

            </div>

        </form>


        @if ($explanation->status !== 'published')

            <section class="mt-8 rounded-2xl border border-emerald-200 bg-emerald-50 p-6">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="font-semibold text-emerald-900">
                            Pronto para publicar?
                        </h2>

                        <p class="mt-1 text-sm text-emerald-700">
                            Ao publicar, esta explicação ficará disponível
                            para os usuários da plataforma.
                        </p>
                    </div>


                    <form
                        method="POST"
                        action="{{ route(
                            'admin.explanations.publish',
                            $explanation
                        ) }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 sm:w-auto"
                        >
                            Publicar explicação
                        </button>

                    </form>

                </div>

            </section>

        @else

            <section class="mt-8 rounded-2xl border border-emerald-200 bg-emerald-50 p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                        ✓
                    </div>

                    <div>
                        <p class="font-semibold text-emerald-900">
                            Explicação publicada
                        </p>

                        <p class="text-sm text-emerald-700">
                            Este conteúdo já está disponível para os usuários.
                        </p>
                    </div>

                </div>
            </section>
        @endif
    </main>
</body>
</html>