<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'original_summary' => 'nullable|string',
            'ai_summary' => 'required|string',
            'url' => 'required|url',
            'source' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'published_at' => 'required|date',
            'relevance_score' => 'required|integer|min:0|max:10',
            'keywords' => 'required|array',
            'keywords.*' => 'string',
            'published' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dados inválidos',
                'errors' => $validator->errors(),
            ], 422);
        }

        $dados = $validator->validated();

        $noticia = News::firstOrCreate(
            ['url' => $dados['url']],
            $dados
        );

        return response()->json([
            'message' => $noticia->wasRecentlyCreated ? 'Notícia criada' : 'Notícia já existia',
            'data' => $noticia,
        ], $noticia->wasRecentlyCreated ? 201 : 200);
    }

    public function index(Request $request)
    {
        $query = News::query()->where('publicar', true);

        if ($request->has('busca')) {
            $query->where('titulo', 'like', '%' . $request->busca . '%');
        }

        if ($request->has('relevancia_minima')) {
            $query->where('score_relevancia', '>=', $request->relevancia_minima);
        }

        $ordenacao = $request->get('ordenar_por', 'data_publicacao');
        $direcao = $request->get('direcao', 'desc');

        return response()->json(
            $query->orderBy($ordenacao, $direcao)->paginate(15)
        );
    }

    public function show(News $noticia)
    {
        return response()->json($noticia);
    }
}