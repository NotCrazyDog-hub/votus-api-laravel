<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LowerHouseApiService
{
    protected string $baseUrl = 'https://dadosabertos.camara.leg.br/api/v2';

    public function listIds(): array
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/deputados", [
            'itens' => 100,
            'siglaUf' => 'CE',
        ]);

        if ($response->failed()) {
            throw new \RuntimeException('Failed to fetch legislators list: ' . $response->status());
        }

        return collect($response->json('dados'))->pluck('id')->all();
    }

    public function getDetails(string $id): array
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/deputados/{$id}");

        if ($response->failed()) {
            throw new \RuntimeException("Failed to fetch details for legislator {$id}: " . $response->status());
        }

        return $response->json('dados');
    }

    public function getCommittees(string $id): array
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/deputados/{$id}/orgaos");

        if ($response->failed()) {
            throw new \RuntimeException("Failed to fetch committees for legislator {$id}: " . $response->status());
        }

        return $response->json('dados') ?? [];
    }

    public function getBillsByLegislator(string $id): array
    {
        $allBills = [];
        $page = 1;

        do {
            $query = http_build_query([
                'idDeputadoAutor' => $id,
                'itens' => 100,
                'pagina' => $page,
            ]) . '&siglaTipo=PL&siglaTipo=PEC';

            $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/proposicoes?{$query}");

            if ($response->failed()) {
                throw new \RuntimeException("Failed to fetch bills for legislator {$id}: " . $response->status());
            }

            $data = $response->json('dados');
            $allBills = array_merge($allBills, $data);
            $page++;
        } while (count($data) === 100);

        return $allBills;
    }
}