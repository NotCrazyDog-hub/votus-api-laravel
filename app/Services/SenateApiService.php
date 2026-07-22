<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class SenateApiService
{
    protected string $baseUrl = 'https://legis.senado.leg.br/dadosabertos';

    public function listParliamentarians(?string $state = null): array
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept' => 'application/json'])
            ->get("{$this->baseUrl}/senador/lista/atual");

        if ($response->failed()) {
            throw new \RuntimeException('Failed to fetch senators list: ' . $response->status());
        }

        $parlamentares = collect($response->json('ListaParlamentarEmExercicio.Parlamentares.Parlamentar') ?? []);

        if ($state !== null) {
            $parlamentares = $parlamentares->filter(
                fn ($p) => ($p['IdentificacaoParlamentar']['UfParlamentar'] ?? null) === $state
            );
        }

        return $parlamentares->values()->all();
    }

    public function getDetails(string $id): array
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept' => 'application/json'])
            ->get("{$this->baseUrl}/senador/{$id}");

        if ($response->failed()) {
            throw new \RuntimeException("Failed to fetch details for senator {$id}: " . $response->status());
        }

        return $response->json('DetalheParlamentar.Parlamentar');
    }

    public function currentLegislatureNumber(array $mandate): ?string
    {
        $today = Carbon::today();

        $candidates = [
            $mandate['PrimeiraLegislaturaDoMandato'] ?? null,
            $mandate['SegundaLegislaturaDoMandato'] ?? null,
        ];

        foreach ($candidates as $legislatura) {
            if ($legislatura === null) {
                continue;
            }

            $inicio = $legislatura['DataInicio'] ?? null;
            $fim = $legislatura['DataFim'] ?? null;

            if ($inicio && $fim && $today->between(Carbon::parse($inicio), Carbon::parse($fim))) {
                return $legislatura['NumeroLegislatura'] ?? null;
            }
        }

        return $mandate['PrimeiraLegislaturaDoMandato']['NumeroLegislatura'] ?? null;
    }

    public function getCommittees(string $id): array
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept' => 'application/json'])
            ->get("{$this->baseUrl}/senador/{$id}/comissoes");

        if ($response->failed()) {
            throw new \RuntimeException("Failed to fetch committees for senator {$id}: " . $response->status());
        }

        $comissoes = $response->json('MembroComissaoParlamentar.Parlamentar.MembroComissoes.Comissao') ?? [];

        if (isset($comissoes['IdentificacaoComissao'])) {
            $comissoes = [$comissoes];
        }

        return collect($comissoes)
            ->filter(fn ($c) => empty($c['DataFim']))
            ->values()
            ->all();
    }

    public function getBillsByLegislator(string $id): array
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept' => 'application/json'])
            ->get("{$this->baseUrl}/processo", [
                'codigoParlamentarAutor' => $id,
                'sigla' => ['PL', 'PEC'],
            ]);

        if ($response->failed()) {
            throw new \RuntimeException("Failed to fetch bills for senator {$id}: " . $response->status());
        }

        return $response->json() ?? [];
    }
}