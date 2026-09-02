<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;


class AgenteController extends Controller
{
    public function perguntar(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'mensagem' => [
                'required',
                'string',
                'min:2',
                'max:2000',
            ],
        ]);

        $webhookUrl = config('services.n8n.webhook_url');

        if (empty($webhookUrl)) {
            return response()->json([
                'message' => 'A URL do n8n não está configurada.',
            ], 500);
        }

        try {
            $response = Http::acceptJson()
                ->timeout(90)
                ->post($webhookUrl, [
                    'mensagem' => $dados['mensagem'],
                ]);

            if ($response->failed()) {
                return response()->json([
                    'message' => 'O n8n não conseguiu processar a pergunta.',
                    'status_n8n' => $response->status(),
                ], 502);
            }

            $resposta = $response->json('resposta');

            if (!is_string($resposta) || trim($resposta) === '') {
                return response()->json([
                    'message' => 'O n8n retornou uma resposta inválida.',
                ], 502);
            }

            return response()->json([
                'resposta' => $resposta,
            ]);
        } catch (Throwable $erro) {
            report($erro);

            return response()->json([
                'message' => 'Não foi possível conectar ao agente de IA.',
            ], 503);
        }
    }
}
