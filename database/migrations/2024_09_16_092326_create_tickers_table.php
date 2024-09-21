<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tickers', function (Blueprint $table) {
            $table->id();
            $table->string('exchange_detail_id'); // foreign key
            $table->string('base'); // BTC, ETH, dll.
            $table->string('target'); // USDT, USD, dll.
            $table->decimal('last', 18, 8)->nullable();
            $table->decimal('volume', 18, 8)->nullable();
            $table->string('trust_score')->nullable(); // "green", "yellow", etc.
            $table->decimal('bid_ask_spread_percentage', 18, 8)->nullable();
            $table->timestamp('last_traded_at')->nullable();
            $table->timestamp('last_fetch_at')->nullable();
            $table->boolean('is_anomaly')->default(false);
            $table->boolean('is_stale')->default(false);
            $table->string('trade_url')->nullable();
            $table->string('coin_id')->nullable();
            $table->string('target_coin_id')->nullable();
            $table->timestamps();
    
            $table->foreign('exchange_detail_id')
            ->references('exchange_id')->on('exchange_details')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        // Hapus foreign key terlebih dahulu
        Schema::table('tickers', function (Blueprint $table) {
            $table->dropForeign(['exchange_detail_id']);
            $table->dropForeign(['market_id']);
        });

        // Setelah foreign key dihapus, barulah drop tabel
        Schema::dropIfExists('tickers');
    }
};
