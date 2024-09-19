<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'year_established',
        'country',
        'description',
        'url',
        'image',
        'trust_score',
        'trust_score_rank',
        'trade_volume_24h_btc',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    
    protected $casts = [
        'year_established' => 'integer',
        'trust_score' => 'integer',
        'trust_score_rank' => 'integer',
        'trade_volume_24h_btc' => 'decimal:8',
    ];

    /**
     * Get the tickers for the exchange.
     */
    public function tickers()
    {
        return $this->hasMany(Ticker::class);
    }
}