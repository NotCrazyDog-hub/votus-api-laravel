<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova explicação</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <main class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="mb-8">
            <a
                href="{{ route('admin.explanations.index') }}"
                class="mb-5 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-slate-900"
            >
                ← Voltar para explicações
            </a>

            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                Administração
            </p>

            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Nova explicação
            </h1>

        </header>

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
            method="POST"
            action="{{ route('admin.explanations.generate') }}"
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
        >
            @csrf


            <div class="border-b border-slate-200 px-6 py-5">

                <h2 class="text-lg font-semibold text-slate-900">
                    Informações do conteúdo
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Esses dados serão utilizados para orientar a pesquisa
                    e a geração do conteúdo.
                </p>

            </div>


            <div class="space-y-6 p-6">

                <div>

                    <label
                        for="title"
                        class="mb-1.5 block text-sm font-medium text-slate-700"
                    >
                        Tema
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Ex.: Câmara dos Deputados"
                        required
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                    >

                    <p class="mt-1.5 text-xs text-slate-500">
                        Informe o assunto principal da explicação.
                    </p>

                </div>

                <div>

                    <label
                        for="question_title"
                        class="mb-1.5 block text-sm font-medium text-slate-700"
                    >
                        Pergunta de abertura
                    </label>

                    <input
                        type="text"
                        id="question_title"
                        name="question_title"
                        value="{{ old('question_title') }}"
                        placeholder="Ex.: Você sabe para que serve a Câmara dos Deputados?"
                        required
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                    >

                    <p class="mt-1.5 text-xs text-slate-500">
                        Essa pergunta será utilizada para introduzir o conteúdo ao usuário.
                    </p>

                </div>


                <div>

                    <label
                        for="category"
                        class="mb-1.5 block text-sm font-medium text-slate-700"
                    >
                        Categoria
                    </label>

                    <select
                        id="category"
                        name="category"
                        required
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                    >

                        <option value="">
                            Selecione uma categoria
                        </option>

                        <option
                            value="Órgãos e instituições"
                            @selected(old('category') === 'Órgãos e instituições')
                        >
                            Órgãos e instituições
                        </option>

                        <option
                            value="Cargos políticos"
                            @selected(old('category') === 'Cargos políticos')
                        >
                            Cargos políticos
                        </option>

                        <option
                            value="Eleições e voto"
                            @selected(old('category') === 'Eleições e voto')
                        >
                            Eleições e voto
                        </option>
                    </select>
                </div>

                <div class="rounded-xl border border-indigo-100 bg-indigo-50 p-4">

                    <p class="text-sm font-medium text-indigo-900">
                        O que acontecerá depois?
                    </p>

                    <p class="mt-1 text-sm leading-6 text-indigo-700">
                        O sistema pesquisará informações nas fontes confiáveis
                        ativas, criará uma explicação e gerará cinco perguntas
                        para o quiz. O conteúdo ficará em revisão antes de
                        ser publicado.
                    </p>
                </div>
            </div>


            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('admin.explanations.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Gerar conteúdo com IA
                </button>
            </div>
        </form>
    </main>
</body>
</html>