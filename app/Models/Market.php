<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'identifier',
        'has_trading_incentive',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'has_trading_incentive' => 'boolean',
    ];

    /**
     * Get the tickers for the market.
     */
    public function tickers()
    {
        return $this->hasMany(Ticker::class);
    }
}