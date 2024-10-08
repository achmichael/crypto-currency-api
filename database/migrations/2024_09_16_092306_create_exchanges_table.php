<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('year_established')->nullable();
            $table->string('country')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->string('has_trading_incentive')->nullable();
            $table->string('image')->nullable();
            $table->integer('trust_score')->nullable();
            $table->integer('trust_score_rank')->nullable();
            $table->decimal('trade_volume_24h_btc', 18, 8)->nullable();
            $table->decimal('trade_volume_24h_btc_normalized', 18, 8)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
