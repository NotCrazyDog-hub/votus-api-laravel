<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Notícias - Eleições</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 900px; margin: 40px auto; padding: 0 20px; background: #f5f5f5; }
        h1 { color: #1a1a1a; }
        .subtitle { color: #666; margin-bottom: 30px; }
        .card { background: white; border-radius: 8px; padding: 20px; margin-bottom: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .card h2 { margin: 0 0 8px; font-size: 18px; }
        .card h2 a { color: #1a4d8f; text-decoration: none; }
        .card h2 a:hover { text-decoration: underline; }
        .meta { color: #666; font-size: 13px; margin-bottom: 10px; }
        .score { display: inline-block; background: #1a4d8f; color: white; padding: 2px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .resumo { color: #333; line-height: 1.5; }
        .tags { margin-top: 10px; }
        .tag { display: inline-block; background: #e8eef7; color: #1a4d8f; padding: 3px 8px; border-radius: 12px; font-size: 12px; margin-right: 6px; }
    </style>
</head>
<body>
    <h1> Painel de Notícias — Período Eleitoral</h1>
    <p class="subtitle">{{ $noticias->count() }} notícias curadas automaticamente pela IA</p>

    @forelse ($noticias as $noticia)
        <div class="card">
            <h2><a href="{{ $noticia->url }}" target="_blank">{{ $noticia->titulo }}</a></h2>
            <div class="meta">
                {{ $noticia->fonte }} · {{ $noticia->data_publicacao->format('d/m/Y H:i') }}
                <span class="score">Relevância: {{ $noticia->score_relevancia }}/10</span>
            </div>
            <p class="resumo">{{ $noticia->resumo_ia }}</p>
            <div class="tags">
                @foreach ($noticia->palavras_chave as $palavra)
                    <span class="tag">{{ $palavra }}</span>
                @endforeach
            </div>
        </div>
    @empty
        <p>Nenhuma notícia encontrada ainda.</p>
    @endforelse
</body>
</html>