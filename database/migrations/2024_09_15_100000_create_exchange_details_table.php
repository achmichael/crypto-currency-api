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
    Schema::create('exchange_details', function (Blueprint $table) {
        $table->string('exchange_id')->primary(); // ID dari API
        $table->string('name');
        $table->integer('year_established')->nullable();
        $table->string('country')->nullable();
        $table->text('description')->nullable();
        $table->string('url');
        $table->string('image')->nullable();
        $table->string('facebook_url')->nullable();
        $table->string('reddit_url')->nullable();
        $table->string('telegram_url')->nullable();
        $table->string('slack_url')->nullable();
        $table->string('other_url_1')->nullable();
        $table->string('other_url_2')->nullable();
        $table->string('twitter_handle')->nullable();
        $table->boolean('has_trading_incentive')->default(false);
        $table->boolean('centralized')->default(true);
        $table->text('public_notice')->nullable();
        $table->text('alert_notice')->nullable();
        $table->integer('trust_score')->nullable();
        $table->integer('trust_score_rank')->nullable();
        $table->decimal('trade_volume_24h_btc', 18, 8)->nullable();
        $table->decimal('trade_volume_24h_btc_normalized', 18, 8)->nullable();
        $table->timestamps();

        $table->foreign('exchange_id')
            ->references('id')->on('exchanges')
            ->onDelete('cascade')
            ->onUpdate('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_details');
    }
};
