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
}