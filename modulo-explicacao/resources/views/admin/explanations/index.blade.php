<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de conteúdo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="mb-10">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                Administração
            </p>

            <h1 class="text-3xl font-bold tracking-tight">
                Gerenciamento de conteúdo
            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                Gerencie as explicações da plataforma e as fontes confiáveis
                utilizadas durante a geração dos conteúdos.
            </p>
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


        {{-- Explicações --}}
        <section class="mb-12 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex flex-col gap-4 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-xl font-semibold">
                        Explicações
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Gere, revise, publique e gerencie os conteúdos da plataforma.
                    </p>
                </div>

                <a
                    href="{{ route('admin.explanations.create') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                >
                    + Nova explicação
                </a>
            </div>


            @if ($explanations->isEmpty())

                <div class="px-6 py-12 text-center">
                    <p class="font-medium text-slate-700">
                        Nenhuma explicação cadastrada.
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Gere uma nova explicação para começar.
                    </p>
                </div>

            @else

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Título
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Categoria
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Ações
                                </th>
                            </tr>
                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach ($explanations as $explanation)

                                <tr class="transition hover:bg-slate-50">

                                    <td class="px-6 py-4">
                                        <p class="font-medium text-slate-900">
                                            {{ $explanation->title }}
                                        </p>

                                        @if ($explanation->question_title)
                                            <p class="mt-1 max-w-xs truncate text-xs text-slate-500">
                                                {{ $explanation->question_title }}
                                            </p>
                                        @endif
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                        {{ $explanation->category }}
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4">

                                        @if ($explanation->status === 'published')

                                            <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                Publicada
                                            </span>

                                        @elseif ($explanation->status === 'review')

                                            <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                Em revisão
                                            </span>

                                        @else

                                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                                {{ $explanation->status }}
                                            </span>

                                        @endif
                                    </td>


                                    <td class="px-6 py-4">

                                        <div class="flex flex-wrap items-center justify-end gap-2">

                                            <a
                                                href="{{ route(
                                                    'admin.explanations.edit',
                                                    $explanation
                                                ) }}"
                                                class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-medium text-slate-700 transition hover:bg-slate-100"
                                            >
                                                Editar
                                            </a>


                                            @if ($explanation->status !== 'published')

                                                <form
                                                    action="{{ route(
                                                        'admin.explanations.publish',
                                                        $explanation
                                                    ) }}"
                                                    method="POST"
                                                >
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-2 text-xs font-medium text-emerald-700 transition hover:bg-emerald-100"
                                                    >
                                                        Publicar
                                                    </button>
                                                </form>

                                            @else

                                                <form
                                                    action="{{ route(
                                                        'admin.explanations.unpublish',
                                                        $explanation
                                                    ) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-2 text-xs font-medium text-amber-700 transition hover:bg-amber-100"
                                                    >
                                                        Ocultar
                                                    </button>
                                                </form>

                                            @endif


                                            <form
                                                action="{{ route(
                                                    'admin.explanations.destroy',
                                                    $explanation
                                                ) }}"
                                                method="POST"
                                                onsubmit="return confirm(
                                                    'Tem certeza que deseja apagar esta explicação definitivamente?'
                                                )"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-medium text-red-700 transition hover:bg-red-100"
                                                >
                                                    Apagar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $explanations->links() }}
                </div>

            @endif

        </section>


        {{-- Fontes confiáveis --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-xl font-semibold">
                    Fontes confiáveis
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Gerencie os sites que podem ser utilizados durante
                    a pesquisa e geração das explicações.
                </p>
            </div>


            <div class="border-b border-slate-200 bg-slate-50/70 px-6 py-6">

                <h3 class="mb-4 text-sm font-semibold">
                    Cadastrar nova fonte
                </h3>

                <form
                    action="{{ route('admin.sources.store') }}"
                    method="POST"
                    class="grid gap-4 md:grid-cols-[1fr_1fr_auto]"
                >
                    @csrf

                    <div>
                        <label
                            for="source-name"
                            class="mb-1.5 block text-sm font-medium text-slate-700"
                        >
                            Nome da fonte
                        </label>

                        <input
                            id="source-name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Ex.: Câmara dos Deputados"
                            required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >
                    </div>


                    <div>
                        <label
                            for="source-url"
                            class="mb-1.5 block text-sm font-medium text-slate-700"
                        >
                            URL ou domínio
                        </label>

                        <input
                            id="source-url"
                            type="text"
                            name="base_url"
                            value="{{ old('domain') }}"
                            placeholder="https://www.camara.leg.br"
                            required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                        <p class="mt-1.5 text-xs text-slate-500">
                            Informe a URL completa ou apenas o domínio.
                        </p>
                    </div>


                    <div class="flex items-center">
                        <button
                            type="submit"
                            class="w-full rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 md:w-auto"
                        >
                            Cadastrar
                        </button>
                    </div>

                </form>
            </div>


            @if ($trustedSources->isEmpty())

                <div class="px-6 py-12 text-center">
                    <p class="font-medium text-slate-700">
                        Nenhuma fonte confiável cadastrada.
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Cadastre uma fonte para utilizá-la nas pesquisas.
                    </p>
                </div>

            @else

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Fonte
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Domínio
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Ações
                                </th>
                            </tr>
                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach ($trustedSources as $source)

                                <tr class="transition hover:bg-slate-50">

                                    <td class="px-6 py-4">

                                        <input
                                            form="source-update-{{ $source->id }}"
                                            type="text"
                                            name="name"
                                            value="{{ $source->name }}"
                                            required
                                            class="w-full min-w-48 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                                        >

                                    </td>


                                    <td class="px-6 py-4">

                                        <input
                                            form="source-update-{{ $source->id }}"
                                            type="text"
                                            name="domain"
                                            value="{{ $source->domain }}"
                                            required
                                            class="w-full min-w-52 rounded-lg border border-slate-300 bg-white px-3 py-2 font-mono text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                                        >

                                    </td>

                                    <td class="px-6 py-4">

                                        <label class="inline-flex cursor-pointer items-center gap-2">

                                            <input
                                                form="source-update-{{ $source->id }}"
                                                type="checkbox"
                                                name="is_active"
                                                value="1"
                                                @checked($source->is_active)
                                                class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                            >

                                            @if ($source->is_active)

                                                <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                    Ativa
                                                </span>

                                            @else

                                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                                    Inativa
                                                </span>

                                            @endif

                                        </label>
                                    </td>


                                    <td class="px-6 py-4">

                                        <div class="flex justify-end gap-2">

                                            <form
                                                id="source-update-{{ $source->id }}"
                                                action="{{ route(
                                                    'admin.sources.update',
                                                    $source
                                                ) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PUT')

                                                <button
                                                    type="submit"
                                                    class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-medium text-slate-700 transition hover:bg-slate-100"
                                                >
                                                    Salvar
                                                </button>
                                            </form>


                                            <form
                                                action="{{ route(
                                                    'admin.sources.destroy',
                                                    $source
                                                ) }}"
                                                method="POST"
                                                onsubmit="return confirm(
                                                    'Tem certeza que deseja excluir esta fonte?'
                                                )"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-medium text-red-700 transition hover:bg-red-100"
                                                >
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @endif
        </section>
    </main>
</body>
</html>