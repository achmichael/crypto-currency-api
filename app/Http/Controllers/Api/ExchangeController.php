<?php

namespace App\Http\Controllers\Api;

use App\Models\Exchange;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function index()
    {
        $exchanges = Exchange::all();
        return response()->json(['data' => $exchanges]);
    }

    public function show($id)
    {
        $exchange = Exchange::find($id);
        return response()->json(['data' => $exchange]);
    }

    public function destroy($id)
    {
        $exchange = Exchange::find($id);
        
        if (!$exchange){
            return response()->json(['message' => 'Exchange not found'], 404);
        }

        $exchange->delete();
    }

    public function update(Request $request, $id)
    {
        $exchange = Exchange::find($id);

        if (!$exchange){
            return response()->json(['message' => 'Exchange not found'], 404);
        }

        $exchange->update($request->all());
        return response()->json(['data' => $exchange]);
    }

    public function tickers($id)
    {
        $tickers = Ticker::where('exchange_id', $id)->with('market')->get();
        return response()->json($tickers);
    }
}
