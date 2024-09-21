<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeDetail extends Model
{
    use HasFactory;

    protected $table = 'exchange_details';
    protected $primaryKey = 'exchange_id';
    protected $keyType = 'string';
    public $incrementing = false;


     protected $fillable = [
        'exchange_id', 
        'name',
        'year_established',
        'country',
        'description',
        'url',
        'image',
        'facebook_url',
        'reddit_url',
        'telegram_url',
        'slack_url',
        'other_url_1',
        'other_url_2',
        'twitter_handle',
        'has_trading_incentive',
        'centralized',
        'public_notice',
        'alert_notice',
        'trust_score',
        'trust_score_rank',
        'trade_volume_24h_btc',
        'trade_volume_24h_btc_normalized',
    ];
}
