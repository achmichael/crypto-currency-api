<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TickerSeeder extends Seeder
{    
    public function run(): void
    {
        DB::table('tickers')->insert([
            [
                'exchange_detail_id' => 'binance',
                'base' => 'BTC',
                'target' => 'USDT',
                'last' => 42000.12345678,
                'volume' => 1500.98765432,
                'trust_score' => 'green',
                'bid_ask_spread_percentage' => 0.10,
                'last_traded_at' => now(),
                'last_fetch_at' => now(),
                'is_anomaly' => false,
                'is_stale' => false,
                'trade_url' => 'https://binance.com/trade/BTC_USDT',
                'coin_id' => 'bitcoin',
                'target_coin_id' => 'tether',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'exchange_detail_id' => 'coinbase',
                'base' => 'ETH',
                'target' => 'USD',
                'last' => 3200.54321098,
                'volume' => 250.12345678,
                'trust_score' => 'yellow',
                'bid_ask_spread_percentage' => 0.20,
                'last_traded_at' => now(),
                'last_fetch_at' => now(),
                'is_anomaly' => false,
                'is_stale' => true,
                'trade_url' => 'https://coinbase.com/trade/ETH_USD',
                'coin_id' => 'ethereum',
                'target_coin_id' => 'usd',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'exchange_detail_id' => 'kraken',
                'base' => 'BNB',
                'target' => 'USDT',
                'last' => 450.12345678,
                'volume' => 350.65432109,
                'trust_score' => 'green',
                'bid_ask_spread_percentage' => 0.15,
                'last_traded_at' => now(),
                'last_fetch_at' => now(),
                'is_anomaly' => true,
                'is_stale' => false,
                'trade_url' => 'https://kraken.com/trade/BNB_USDT',
                'coin_id' => 'binancecoin',
                'target_coin_id' => 'tether',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
