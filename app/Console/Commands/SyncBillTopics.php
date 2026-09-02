<?php

namespace App\Console\Commands;

use App\Models\Bill;
use App\Models\Topic;
use App\Services\LowerHouseApiService;
use App\Services\SenateApiService;
use Illuminate\Console\Command;

class SyncBillTopics extends Command
{
    protected $signature = 'sync:bill-topics';
    protected $description = 'Fetch and store topics/themes for bills already registered in the database';

    public function handle(LowerHouseApiService $lowerHouseApi, SenateApiService $senateApi)
    {
        $this->syncLowerHouse($lowerHouseApi);
        $this->syncSenate($senateApi);

        $this->info('Bill topics sync completed.');
    }

    protected function syncLowerHouse(LowerHouseApiService $api): void
    {
        $bills = Bill::where('chamber', 'lower_house')->get();
        $this->info("Syncing topics for {$bills->count()} lower house bills.");
        $bar = $this->output->createProgressBar($bills->count());

        foreach ($bills as $bill) {
            try {
                $topics = $api->getTopics($bill->external_id);
                $this->attachTopics($bill, $topics, 'lower_house');
            } catch (\Throwable $e) {
                $this->error("Failed to sync topics for bill {$bill->external_id}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }

    protected function syncSenate(SenateApiService $api): void
    {
        $bills = Bill::where('chamber', 'senate')->get();
        $this->info("Syncing topics for {$bills->count()} senate bills.");
        $bar = $this->output->createProgressBar($bills->count());

        foreach ($bills as $bill) {
            try {
                $topics = $api->extractTopics($bill->raw_data ?? []);
                $this->attachTopics($bill, $topics, 'senate');
            } catch (\Throwable $e) {
                $this->error("Failed to sync topics for bill {$bill->external_id}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }

    protected function attachTopics(Bill $bill, array $topics, string $chamber): void
    {
        foreach ($topics as $t) {
            $topic = Topic::firstOrCreate(
                ['name' => $t['name'], 'chamber' => $chamber],
                ['external_id' => $t['external_id'] ?? null]
            );

            $bill->topics()->syncWithoutDetaching([
                $topic->id => ['relevance' => $t['relevance'] ?? null],
            ]);
        }
    }
}