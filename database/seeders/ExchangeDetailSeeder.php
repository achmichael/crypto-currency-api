<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExchangeDetailSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('exchange_details')->insert([
            [
                'exchange_id' => 'binance',
                'name' => 'Binance',
                'country' => 'China',
                'url' => 'https://binance.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'exchange_id' => 'coinbase',
                'name' => 'Coinbase',
                'country' => 'USA',
                'url' => 'https://coinbase.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'exchange_id' => 'kraken',
                'name' => 'Kraken',
                'country' => 'USA',
                'url' => 'https://kraken.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
