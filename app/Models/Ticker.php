<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exchange_detail_id',
        'base',
        'target',
        'last',
        'volume',
        'bid_ask_spread_percentage',
        'converted_last_btc',
        'converted_last_eth',
        'converted_last_usd',
        'trust_score',
        'bid_ask_spread_percentage',
        'timestamp',
        'is_anomaly',
        'is_stale',
        'trade_url',
        'coin_id',
        'target_coin_id',
        'last_traded_at',
        'last_fetch_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'last' => 'decimal:8',
        'volume' => 'decimal:8',
        'converted_last_btc' => 'decimal:8',
        'converted_last_eth' => 'decimal:8',
        'converted_last_usd' => 'decimal:8',
        'bid_ask_spread_percentage' => 'decimal:6',
        'timestamp' => 'datetime',
        'last_traded_at' => 'datetime',
        'last_fetch_at' => 'datetime',
        'is_anomaly' => 'boolean',
        'is_stale' => 'boolean',
    ];

    /**
     * Get the exchange that owns the ticker.
     */
    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }

    /**
     * Get the market that owns the ticker.
     */
    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}