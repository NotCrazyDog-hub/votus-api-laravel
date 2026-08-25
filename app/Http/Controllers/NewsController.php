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
            'titulo' => 'required|string|max:255',
            'resumo_original' => 'nullable|string',
            'resumo_ia' => 'required|string',
            'url' => 'required|url',
            'fonte' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:255',
            'data_publicacao' => 'required|date',
            'score_relevancia' => 'required|integer|min:0|max:10',
            'palavras_chave' => 'required|array',
            'palavras_chave.*' => 'string',
            'publicar' => 'boolean',
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