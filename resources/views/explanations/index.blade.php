<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explicações</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <header class="mb-12 max-w-3xl">
            <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                Política e cidadania
            </p>

            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                Você sabe?
            </h1>

            <p class="mt-4 text-base leading-7 text-slate-500 sm:text-lg">
                Entenda conceitos importantes sobre política e cidadania
                de forma simples e acessível.
            </p>
        </header>

        @if ($explanations->isEmpty())
            <section class="rounded-2xl border border-slate-200 bg-white px-6 py-14 text-center shadow-sm">
                <h2 class="text-lg font-semibold text-slate-800">
                    Nenhuma explicação disponível
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Novos conteúdos serão publicados em breve.
                </p>
            </section>

        @else

            <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($explanations as $explanation)
                    <article
                        class="group flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-md"
                    >

                        <div class="mb-5">

                            <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                {{ $explanation->category }}
                            </span>

                        </div>

                        <h2 class="text-xl font-semibold leading-7 text-slate-900">
                            {{ $explanation->question_title }}
                        </h2>

                        <p class="mt-3 line-clamp-4 text-sm leading-6 text-slate-500">
                            {{ $explanation->summary }}
                        </p>

                        <div class="mt-auto pt-6">

                            <a
                                href="{{ route(
                                    'explanations.show',
                                    $explanation
                                ) }}"
                                class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 transition group-hover:text-indigo-700"
                            >
                                Entenda

                                <span
                                    aria-hidden="true"
                                    class="transition-transform group-hover:translate-x-1"
                                >
                                    →
                                </span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </section>

            <div class="mt-10">
                {{ $explanations->links() }}
            </div>
        @endif
    </main>
</body>
</html>