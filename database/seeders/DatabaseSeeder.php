<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ExchangeSeeder;
use Database\Seeders\ExchangeDetailSeeder;
use Database\Seeders\TickerSeeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(
            [
                ExchangeSeeder::class,
                ExchangeDetailSeeder::class,
                TickerSeeder::class,
            ]
        );
    }
}
