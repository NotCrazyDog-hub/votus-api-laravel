<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Enums\LegislatorStatus;
use App\Services\Concerns\NormalizesProfessionNames;

class SenateApiService
{
    use NormalizesProfessionNames;
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

    public function getMandate(string $id): ?array
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept' => 'application/json'])
            ->get("{$this->baseUrl}/senador/{$id}/mandatos");

        if ($response->failed()) {
            throw new \RuntimeException("Failed to fetch mandate for senator {$id}: " . $response->status());
        }

        $mandatos = $response->json('MandatoParlamentar.Parlamentar.Mandatos.Mandato') ?? [];

        if (isset($mandatos['CodigoMandato'])) {
            $mandatos = [$mandatos];
        }

        if (empty($mandatos)) {
            return null;
        }

        return $this->selectCurrentMandate($mandatos);
    }

    protected function selectCurrentMandate(array $mandatos): array
    {
        $today = Carbon::today();

        foreach ($mandatos as $mandato) {
            foreach ([$mandato['PrimeiraLegislaturaDoMandato'] ?? null, $mandato['SegundaLegislaturaDoMandato'] ?? null] as $legislatura) {
                if ($legislatura === null) {
                    continue;
                }

                $inicio = $legislatura['DataInicio'] ?? null;
                $fim = $legislatura['DataFim'] ?? null;

                if ($inicio && $fim && $today->between(Carbon::parse($inicio), Carbon::parse($fim))) {
                    return $mandato;
                }
            }
        }

        return collect($mandatos)->sortByDesc(fn ($m) => (int) ($m['CodigoMandato'] ?? 0))->first();
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


    public function determineStatus(array $mandate, bool $isAlternate = false): LegislatorStatus
    {
        if (empty($mandate)) {
            return LegislatorStatus::Unknown;
        }

        $today = Carbon::today();

        $legislaturas = array_filter([
            $mandate['PrimeiraLegislaturaDoMandato'] ?? null,
            $mandate['SegundaLegislaturaDoMandato'] ?? null,
        ]);

        $fimMandato = collect($legislaturas)
            ->pluck('DataFim')
            ->filter()
            ->map(fn ($d) => Carbon::parse($d))
            ->max();

        if ($fimMandato && $today->greaterThan($fimMandato)) {
            return LegislatorStatus::Former;
        }

        $exercicios = $mandate['Exercicios']['Exercicio'] ?? [];
        if (isset($exercicios['CodigoExercicio'])) {
            $exercicios = [$exercicios];
        }

        $exercicioAtual = collect($exercicios)
            ->sortByDesc(fn ($e) => Carbon::parse($e['DataInicio']))
            ->first();

        $statusEmExercicio = $isAlternate ? LegislatorStatus::Inactive : LegislatorStatus::Active;

        if (!$exercicioAtual) {
            return $statusEmExercicio;
        }

        $temCausaAfastamento = !empty($exercicioAtual['SiglaCausaAfastamento']);
        $dataFim = $exercicioAtual['DataFim'] ?? null;

        if (!$isAlternate && $temCausaAfastamento && $dataFim === null) {
            return LegislatorStatus::OnLeave;
        }

        if (!$isAlternate && $dataFim !== null && $today->lessThanOrEqualTo(Carbon::parse($dataFim))) {
            return LegislatorStatus::OnLeave;
        }

        if ($isAlternate && $dataFim !== null && $today->greaterThan(Carbon::parse($dataFim))) {
            return LegislatorStatus::Inactive;
        }

        return $statusEmExercicio;
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

    public function getProfessions(string $id): array
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept' => 'application/json'])
            ->get("{$this->baseUrl}/senador/{$id}/historicoAcademico");

        if ($response->failed()) {
            throw new \RuntimeException("Failed to fetch professions for senator {$id}: " . $response->status());
        }

        $professions = $response->json('HistoricoAcademicoParlamentar.Parlamentar.Profissoes.Profissao') ?? [];

        if (isset($professions['NomeProfissao'])) {
            $professions = [$professions];
        }

        return collect($professions)
            ->filter(fn ($p) => !empty($p['NomeProfissao']))
            ->map(fn ($p) => [
                'original_name' => $p['NomeProfissao'],
                'normalized_name' => $this->normalizeProfessionName($p['NomeProfissao']),
                'source' => 'senate',
                'is_primary' => ($p['IndicadorAtividadePrincipal'] ?? null) === 'Sim',
                'registered_at' => null,
                'camara_code' => null,
            ])
            ->values()
            ->all();
    }
}