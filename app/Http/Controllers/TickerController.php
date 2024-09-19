<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticker;

class TickerController extends Controller
{
    
    public static function index ()
    {
        $tickers = Ticker::all();

        return response()->json(['data' => $tickers, 'success' => true]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'exchange_detail_id' => 'required|string|max:255',
            'base' => 'required|string|max:255',
            'target' => 'required|string|max:255',
            'last' => 'required|numeric',
            'volume' => 'required|numeric',
            'trust_score' => 'required|string',
            'bid_ask_spread_percentage' => 'required|numeric',
            'last_traded_at' => 'required|timestamp',
            'last_fetch_at' => 'required|timestamp',
            'is_anomaly' => 'required|boolean',
            'is_stale' => 'required|boolean',
            'trade_url' => 'required|url',
            'coin_id' => 'required|string',
            'target_coin_id' => 'required|string',
        ]);

        $ticker = Ticker::create($validateData);

        return response()->json(['data' => $ticker, 'success' => true]);
    }

    public function show(string $id)
    {
        // mencari semua tickers berdasarkan exchange_detail_id
        $tickers = Ticker::where('exchange_detail_id', $id)->get();

        // cek apakah ticker tersedia atau tidak 
        if ($tickers->isEmpty())
        {
            return response()->json(['message' => 'Ticker not found', 'success' => false], 404);
        }

        return response()->json(['data' => $tickers, 'success' => true]);
    }   

    public function update(Request $request, string $id)
    {
        $ticker = Ticker::find($id);

        if (!$ticker) {
            return response()->json(['message' => 'Ticker not found', 'success' => false], 404);
        }

        $validateData = $request->validate([
            'exchange_detail_id' => 'required|string|max:255',
            'base' => 'required|string|max:255',
            'target' => 'required|string|max:255',
            'last' => 'required|numeric',
            'volume' => 'required|numeric',
            'trust_score' => 'required|string',
            'bid_ask_spread_percentage' => 'required|numeric',
            'last_traded_at' => 'required|timestamp',
            'last_fetch_at' => 'required|timestamp',
            'is_anomaly' => 'required|boolean',
            'is_stale' => 'required|boolean',
            'trade_url' => 'required|url',
            'coin_id' => 'required|string',
            'target_coin_id' => 'required|string',
        ]);

        $ticker->update($validateData);

        return response()->json(['data' => $ticker, 'success' => true]);
    }

    public function destroy(string $id)
    {
        $ticker = Ticker::find($id);

        if (!$ticker) {
            return response()->json(['message' => 'Ticker not found', 'success' => false], 404);
        }

        $ticker->delete();
    }

}


