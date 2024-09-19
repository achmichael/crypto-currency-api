<?php

namespace App\Console\Commands;

use App\Models\Exchange;
use App\Models\ExchangeDetail;
use App\Models\Ticker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ExchangeDetails extends Command
{
    protected $signature = 'fetch:details';
    protected $description = 'Process fetching data from public API and store into database';

    public function handle()
    {
        $this->info('Processing fetching data...');

        $apiKey = env('API_KEY');

        $exchanges = Exchange::all();

        $processedExchanges = 0;
        $failedExchanges = 0;

        foreach ($exchanges as $exchange) {
            // memulai transaksi database
            // digunakan untuk konsistensi data, jika ada error pada tengah2 operasi maka semua query sebelumnya akan dibatalkan 
            DB::beginTransaction();
            try {
                $processedExchanges++;
                $this->info("Processing exchange {$processedExchanges} of {$exchanges->count()}: {$exchange->id}");
                
                $response = Http::get(env('BASE_URL_API') . "/{$exchange->id}", [
                    'x-rapidapi-key' => $apiKey,
                ]);

                if ($response->failed()) {
                    throw new \Exception('Failed to fetch data from API with status code : ' . $response->status());
                }

                $data = $response->json();
                $this->info('Processing data...');
                // operasi pertama, mencari exchange_detail berdasarkan exchange_id
                $exchangeDetail = ExchangeDetail::where('exchange_id', $exchange->id)->first();
                
                // jika exchange_detail tidak ditemukan, maka buat exchange_detail baru
                if (!$exchangeDetail) {
                    $exchangeDetail = new ExchangeDetail();
                    $exchangeDetail->exchange_id = $exchange->id;
                }

                // mengisi data exchange_detail
                $exchangeDetail->fill([
                    'name' => $data['name'] ?? null,
                    'year_established' => $data['year_established'] ?? null,
                    'country' => $data['country'] ?? null,
                    'description' => $data['description'] ?? null,
                    'url' => $data['url'] ?? null,
                    'image' => $data['image'] ?? null,
                    'facebook_url' => $data['facebook_url'] ?? null,
                    'reddit_url' => $data['reddit_url'] ?? null,
                    'telegram_url' => $data['telegram_url'] ?? null,
                    'slack_url' => $data['slack_url'] ?? null,
                    'other_url_1' => $data['other_url_1'] ?? null,
                    'other_url_2' => $data['other_url_2'] ?? null,
                    'twitter_handle' => $data['twitter_handle'] ?? null,
                    'has_trading_incentive' => $data['has_trading_incentive'] ?? false,
                    'centralized' => $data['centralized'] ?? true,
                    'public_notice' => $data['public_notice'] ?? null,
                    'alert_notice' => $data['alert_notice'] ?? null,
                    'trust_score' => $data['trust_score'] ?? null,
                    'trust_score_rank' => $data['trust_score_rank'] ?? null,
                    'trade_volume_24h_btc' => $data['trade_volume_24h_btc'] ?? null,
                    'trade_volume_24h_btc_normalized' => $data['trade_volume_24h_btc_normalized'] ?? null,
                ]);

                // menyimpan data exchange_detail
                $exchangeDetail->save();

                $this->info('Exchange details saved...');
                
                $this->info('Processing tickers');
                $tickerCount = 0;
                // operasi kedua, menyimpan semua data ticker dari setiap exchange detail
                foreach ($data['tickers'] as $tickerData) {
                    try {
                        // Mencari ticker pada table tickers yang mempunyai exchange_detail_id yang sama dengan exchange_id dari exchange_detail
                        $ticker = Ticker::where('exchange_detail_id', $exchangeDetail->exchange_id)
                                        ->where('base', $tickerData['base'] ?? null)
                                        ->where('target', $tickerData['target'] ?? null)
                                        ->first();

                        if (!$ticker) {
                            $ticker = new Ticker();
                            $ticker->exchange_detail_id = $exchangeDetail->exchange_id;
                            $ticker->base = $tickerData['base'] ?? null;
                            $ticker->target = $tickerData['target'] ?? null;
                        }


                        // mengisi data ticker
                        $ticker->fill([
                            'last' => $tickerData['last'] ?? null,
                            'volume' => $tickerData['volume'] ?? null,
                            'trust_score' => $tickerData['trust_score'] ?? null,
                            'bid_ask_spread_percentage' => $tickerData['bid_ask_spread_percentage'] ?? null,
                            'last_traded_at' => $tickerData['last_traded_at'] ?? null,
                            'last_fetch_at' => $tickerData['last_fetch_at'] ?? null,
                            'is_anomaly' => $tickerData['is_anomaly'] ?? false,
                            'is_stale' => $tickerData['is_stale'] ?? false,
                            'trade_url' => $tickerData['trade_url'] ?? null,
                            'coin_id' => $tickerData['coin_id'] ?? null,
                            'target_coin_id' => $tickerData['target_coin_id'] ?? null,
                        ]);

                        $ticker->save();
                        $tickerCount++;
                    } catch (\Exception $e) {
                        Log::error("Error processing ticker for exchange {$exchange->id}: " . $e->getMessage(), [
                            'exchange_id' => $exchange->id,
                            'ticker_data' => $tickerData,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }

                $this->info("Processed {$tickerCount} tickers for exchange {$exchange->id}");

                DB::commit();
                $this->info("Details for exchange ID: {$exchange->id} fetched and saved.");
            } catch (\Exception $e) {
                DB::rollBack();
                $failedExchanges++;
                Log::error("Error processing exchange {$exchange->id}: " . $e->getMessage(), [
                    'exchange_id' => $exchange->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                $this->error("Failed to process exchange {$exchange->id}: " . $e->getMessage());
            }
        }
        
        $this->info("Processed {$processedExchanges} exchanges. {$failedExchanges} exchanges failed.");
        $this->info('All details fetched successfully.');
    }
}