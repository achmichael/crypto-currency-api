<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('exchanges')->insert([
            [
                'id' => 'binance',
                'name' => 'Binance',
                'year_established' => 2017,
                'country' => 'China',
                'description' => 'Binance is a cryptocurrency exchange that provides a platform for trading various cryptocurrencies.',
                'url' => 'https://www.binance.com',
                'image' => 'https://www.binance.com/images/binance_logo.png',
                'trust_score' => 10,
                'trust_score_rank' => 1,
                'trade_volume_24h_btc' => 50000.1234,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'coinbase',
                'name' => 'Coinbase',
                'year_established' => 2012,
                'country' => 'USA',
                'description' => 'Coinbase is a digital currency wallet and platform where merchants and consumers can transact with new digital currencies like bitcoin, ethereum, and litecoin.',
                'url' => 'https://www.coinbase.com',
                'image' => 'https://www.coinbase.com/images/coinbase_logo.png',
                'trust_score' => 9,
                'trust_score_rank' => 2,
                'trade_volume_24h_btc' => 30000.5678,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'kraken',
                'name' => 'Kraken',
                'year_established' => 2011,
                'country' => 'USA',
                'description' => 'Kraken is a US-based cryptocurrency exchange, founded in 2011, offering a platform for trading various cryptocurrencies.',
                'url' => 'https://www.kraken.com',
                'image' => 'https://www.kraken.com/images/kraken_logo.png',
                'trust_score' => 8,
                'trust_score_rank' => 3,
                'trade_volume_24h_btc' => 20000.8910,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
