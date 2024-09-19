<?php

namespace App\Console\Commands;

use App\Models\Exchange;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ProcessExchangeData extends Command
{
    protected $signature = 'fetch:public-api';
    protected $description = 'Process fetching data from public API and store into database';

    public function handle()
    {
        $this->info('Processing fetching data...');
        $apiKey = env('API_KEY');

        $response = Http::get(env('BASE_URL_API'), [
            'x-rapidapi-key' => $apiKey,
        ]);

        if ($response->failed()) {
            $this->error('Failed to fetch data from API');
            return;
        }

        $result = $response->json();

        $this->info('Processing data...');

        foreach ($result as $data) {
            Exchange::updateOrCreate(
                ['id' => $data['id']], // Condition for existing data
                [   // Data to be updated
                    'name' => $data['name'],
                    'year_established' => $data['year_established'] ?? null,
                    'country' => $data['country'] ?? null,
                    'description' => $data['description'] ?? null,
                    'url' => $data['url'],
                    'image' => $data['image'],
                    'trust_score' => $data['trust_score'] ?? null,
                    'trust_score_rank' => $data['trust_score_rank'] ?? null,
                    'trade_volume_24h_btc' => $data['trade_volume_24h_btc'] ?? null,
                ]
            );
        }
    }
}
