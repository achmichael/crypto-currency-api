<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exchange;

class ExchangeController extends Controller
{
    public static function index () 
    {
        $exchanges = Exchange::all();

        return response()->json(['data' => $exchanges, 'success' => true]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'year_established' => 'required|integer',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'image' => 'required|url',
            'trust_score' => 'required|integer',
            'trust_score_rank' => 'required|integer',
            'trade_volume_24h_btc' => 'required|numeric',
        ]);

        $exchange = Exchange::create($validateData);

        return response()->json(['data' => $exchange, 'success' => true]);
    }

    public function show(string $id)
    {
        $exchange = Exchange::find($id);

        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found', 'success' => false], 404);
        }

        return response()->json(['data' => $exchange, 'success' => true], 200);
    }


    public function update(Request $request, string $id)
    {
        $exchange = Exchange::find($id);

        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found', 'success' => false], 404);
        }

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'year_established' => 'required|integer',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'image' => 'required|url',
            'trust_score' => 'required|integer',
            'trust_score_rank' => 'required|integer',
            'trade_volume_24h_btc' => 'required|numeric',
        ]);

        $exchange->update($validateData);

        return response()->json([
            'data' => $exchange,
            'success' => true,
            'message' => 'Exchange updated successfully'
        ]);
    }

    public function destroy (string $id)
    {
        $exchange = Exchange::find($id);

        if (!$exchange)
        {
            return response()->json(['message' => 'Exchange not found', 'success' => false], 404);
        }

        $exchange->delete();

        return response()->json(['message' => 'Exchange deleted successfully', 'success' => true]);
    }
}
