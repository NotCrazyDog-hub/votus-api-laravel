<?php

namespace App\Console\Commands;

use App\Models\Legislator;
use App\Services\LowerHouseApiService;
use Illuminate\Console\Command;

class SyncLowerHouseLegislators extends Command
{
    protected $signature = 'sync:legislators-lower-house';
    protected $description = 'Fetch legislators from Câmara dos Deputados API and save to database';

    public function handle(LowerHouseApiService $api)
    {
        $ids = $api->listIds();
        $this->info('Found ' . count($ids) . ' legislators to sync.');
        $bar = $this->output->createProgressBar(count($ids));

        foreach ($ids as $id) {
            $data = $api->getDetails($id);
            $status = $data['ultimoStatus'];
            unset($data['cpf']);

            Legislator::updateOrCreate(
                ['external_id' => $data['id'], 'chamber' => 'lower_house'],
                [
                    'civil_name' => $data['nomeCivil'],
                    'parliamentary_name' => $status['nome'],
                    'photo_url' => $status['urlFoto'],
                    'party' => $status['siglaPartido'],
                    'state' => $status['siglaUf'],
                    'legislature' => $status['idLegislatura'] ?? null,
                    'electoral_status' => match(true) {
                        str_contains(strtolower($mandate['DescricaoParticipacao'] ?? ''), 'suplente') => 'alternate',
                        default => 'sitting',
                    },
                    'status' => match(strtolower($status['situacao'] ?? '')) {
                        'exercício' => 'active',
                        'afastado' => 'on_leave',
                        default => 'unknown',
                    },
                    'phone' => $status['gabinete']['telefone'] ?? null,
                    'email' => $status['gabinete']['email'] ?? null,
                    'social_media' => $data['redeSocial'] ?? [],
                    'raw_data' => $data,
                ]
            );

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Sync completed.');
    }
}