<?php

namespace App\Console\Commands;

use App\Models\Legislator;
use App\Services\SenateApiService;
use Illuminate\Console\Command;

class SyncSenateLegislators extends Command
{
    protected $signature = 'sync:legislators-senate';
    protected $description = 'Fetch senators from Senado Federal API and save to database';

    public function handle(SenateApiService $api)
    {
        $parliamentarians = $api->listParliamentarians('CE');
        $this->info('Found ' . count($parliamentarians) . ' senators to sync.');
        $bar = $this->output->createProgressBar(count($parliamentarians));

        foreach ($parliamentarians as $p) {
            try {
                $identification = $p['IdentificacaoParlamentar'] ?? [];
                $mandate = $p['Mandato'] ?? [];

                $details = $api->getDetails($identification['CodigoParlamentar']);

                Legislator::updateOrCreate(
                    ['external_id' => $identification['CodigoParlamentar'], 'chamber' => 'senate'],
                    [
                        'civil_name' => $identification['NomeCompletoParlamentar'] ?? null,
                        'parliamentary_name' => $identification['NomeParlamentar'] ?? null,
                        'photo_url' => $identification['UrlFotoParlamentar'] ?? null,
                        'party' => $identification['SiglaPartidoParlamentar'] ?? null,
                        'state' => $identification['UfParlamentar'] ?? null,
                        'legislature' => $api->currentLegislatureNumber($mandate),
                        'electoral_status' => match(true) {
                            str_contains(strtolower($mandate['DescricaoParticipacao'] ?? ''), 'suplente') => 'alternate',
                            default => 'sitting',
                        },
                        'status' => 'active',
                        'phone' => null,
                        'email' => $identification['EmailParlamentar'] ?? null,
                        'official_website' => $identification['UrlPaginaParticular'] ?? null,
                        'social_media' => [],
                        'raw_data' => array_merge($details, ['Mandato' => $mandate]),
                    ]
                );
            } catch (\Throwable $e) {
                $this->error("Failed to sync senator {$identification['CodigoParlamentar']}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Sync completed.');
    }
}