<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExchangeDetail;
use App\Models\Exchange;

class ExchangeDetailController extends Controller
{
    public static function index ()
    {
        $exchanges = ExchangeDetail::all();

        return response()->json(['data' => $exchanges, 'success' => true]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'exchange_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'year_established' => 'required|integer',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'image' => 'required|url',
            'facebook_url' => 'required|url',
            'reddit_url' => 'required|url',
            'telegram_url' => 'required|url',
            'slack_url' => 'required|url',
            'other_url_1' => 'required|url',
            'other_url_2' => 'required|url',
            'twitter_handle' => 'required|url',
            'has_trading_incentive' => 'required|boolean',
            'centralized' => 'required|boolean',
            'public_notice' => 'required|string',
            'alert_notice' => 'required|string',
            'trust_score' => 'required|integer',
            'trust_score_rank' => 'required|integer',
            'trade_volume_24h_btc' => 'required|numeric',
            'trade_volume_24h_btc_normalized' => 'required|numeric',
        ]);

        $exchangeId = $validateData['exchange_id'];

        
        $exchange = Exchange::where('exchange_id', $exchangeId)->first();
        
        if (!$exchange){
            return response()->json(['message' => 'Exchange not found', 'success' => false], 404);  
        }        

        $exchange = ExchangeDetail::create($validateData);

        return response()->json(['data' => $exchange, 'success' => true]);
    }

    public function show(string $id)
    {
        $exchange = ExchangeDetail::find($id);

        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found', 'success' => false], 404);
        }

        return response()->json(['data' => $exchange, 'success' => true], 200);
    }

    public function update(Request $request, string $id)
    {
        $exchange = ExchangeDetail::find($id);

        if (!$exchange)
        {
            return response()->json(['message' => 'Exchange not found', 'success' => false], 404);
        }

        $validateData = $request->validate([
            'exchange_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'year_established' => 'required|integer',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'image' => 'required|url',
            'facebook_url' => 'required|url',
            'reddit_url' => 'required|url',
            'telegram_url' => 'required|url',
            'slack_url' => 'required|url',
            'other_url_1' => 'required|url',
            'other_url_2' => 'required|url',
            'twitter_handle' => 'required|url',
            'has_trading_incentive' => 'required|boolean',
            'centralized' => 'required|boolean',
            'public_notice' => 'required|string',
            'alert_notice' => 'required|string',
            'trust_score' => 'required|integer',
            'trust_score_rank' => 'required|integer',
            'trade_volume_24h_btc' => 'required|numeric',
            'trade_volume_24h_btc_normalized' => 'required|numeric',
        ]);

        $exchange->update($validateData);

        return response()->json(['data' => $exchange, 'success' => true], 200);
    }

    public function destroy(string $id)
    {
        $exchange = ExchangeDetail::find($id);

        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found', 'success' => false], 404);
        }

        $exchange->delete();

        return response()->json(['message' => 'Exchange deleted', 'success' => true], 200);
    }
}
