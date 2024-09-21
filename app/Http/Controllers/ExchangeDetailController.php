<?php

namespace App\Http\Controllers;

use App\Models\ExchangeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ExchangeDetailController extends Controller
{
    public static function index($id)
    {
        // nilai id dari parameter tersebut di dapatkan dari route
        $exchanges = ExchangeDetail::where('exchange_id', $id)->get();

        return response()->json(['data' => $exchanges, 'success' => true]);
    }

    public function store(Request $request)
    {
        $rules = [
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
        ];

        // Definisikan pesan kesalahan khusus
        $messages = [
            'exchange_id.required' => 'Exchange ID wajib diisi.',
            'name.required' => 'Nama wajib diisi.',
            'year_established.required' => 'Tahun pendirian wajib diisi.',
            'year_established.integer' => 'Tahun pendirian harus berupa angka.',
            'country.required' => 'Negara asal wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'url.required' => 'URL wajib diisi.',
            'url.url' => 'Format URL tidak valid.',
            'image.required' => 'URL gambar wajib diisi.',
            'facebook_url.required' => 'URL Facebook wajib diisi.',
            'reddit_url.required' => 'URL Reddit wajib diisi.',
            'telegram_url.required' => 'URL Telegram wajib diisi.',
            'slack_url.required' => 'URL Slack wajib diisi.',
            'other_url_1.required' => 'URL lain 1 wajib diisi.',
            'other_url_2.required' => 'URL lain 2 wajib diisi.',
            'twitter_handle.required' => 'URL Twitter wajib diisi.',
            'has_trading_incentive.required' => 'Incentive trading wajib diisi.',
            'has_trading_incentive.boolean' => 'Incentive trading harus berupa nilai boolean.',
            'centralized.required' => 'Centralized wajib diisi.',
            'centralized.boolean' => 'Centralized harus berupa nilai boolean.',
            'public_notice.required' => 'Public notice wajib diisi.',
            'alert_notice.required' => 'Alert notice wajib diisi.',
            'trust_score.required' => 'Trust score wajib diisi.',
            'trust_score.integer' => 'Trust score harus berupa angka.',
            'trust_score_rank.required' => 'Trust score rank wajib diisi.',
            'trust_score_rank.integer' => 'Trust score rank harus berupa angka.',
            'trade_volume_24h_btc.required' => 'Trade volume dalam 24 jam (BTC) wajib diisi.',
            'trade_volume_24h_btc.numeric' => 'Trade volume dalam 24 jam (BTC) harus berupa angka.',
            'trade_volume_24h_btc_normalized.required' => 'Trade volume 24h BTC Normalized wajib diisi.',
            'trade_volume_24h_btc_normalized.numeric' => 'Trade volume 24h BTC Normalized harus berupa angka.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Jika validasi gagal, kembalikan pesan kesalahan
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $exchange = ExchangeDetail::create($request->all());

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

        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found', 'success' => false], 404);
        }

        $rules = [
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
        ];

        // Definisikan pesan kesalahan khusus
        $messages = [
            'exchange_id.required' => 'Exchange ID wajib diisi.',
            'name.required' => 'Nama wajib diisi.',
            'year_established.required' => 'Tahun pendirian wajib diisi.',
            'year_established.integer' => 'Tahun pendirian harus berupa angka.',
            'country.required' => 'Negara asal wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'url.required' => 'URL wajib diisi.',
            'url.url' => 'Format URL tidak valid.',
            'image.required' => 'URL gambar wajib diisi.',
            'facebook_url.required' => 'URL Facebook wajib diisi.',
            'reddit_url.required' => 'URL Reddit wajib diisi.',
            'telegram_url.required' => 'URL Telegram wajib diisi.',
            'slack_url.required' => 'URL Slack wajib diisi.',
            'other_url_1.required' => 'URL lain 1 wajib diisi.',
            'other_url_2.required' => 'URL lain 2 wajib diisi.',
            'twitter_handle.required' => 'URL Twitter wajib diisi.',
            'has_trading_incentive.required' => 'Incentive trading wajib diisi.',
            'has_trading_incentive.boolean' => 'Incentive trading harus berupa nilai boolean.',
            'centralized.required' => 'Centralized wajib diisi.',
            'centralized.boolean' => 'Centralized harus berupa nilai boolean.',
            'public_notice.required' => 'Public notice wajib diisi.',
            'alert_notice.required' => 'Alert notice wajib diisi.',
            'trust_score.required' => 'Trust score wajib diisi.',
            'trust_score.integer' => 'Trust score harus berupa angka.',
            'trust_score_rank.required' => 'Trust score rank wajib diisi.',
            'trust_score_rank.integer' => 'Trust score rank harus berupa angka.',
            'trade_volume_24h_btc.required' => 'Trade volume dalam 24 jam (BTC) wajib diisi.',
            'trade_volume_24h_btc.numeric' => 'Trade volume dalam 24 jam (BTC) harus berupa angka.',
            'trade_volume_24h_btc_normalized.required' => 'Trade volume 24h BTC Normalized wajib diisi.',
            'trade_volume_24h_btc_normalized.numeric' => 'Trade volume 24h BTC Normalized harus berupa angka.',
        ];

        // Melakukan validasi secara manual
        $validator = Validator::make($request->all(), $rules, $messages);

        // Mengecek apakah validasi gagal
        if ($validator->fails()) {
            // Jika validasi gagal, kembalikan pesan kesalahan
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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
