<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        $currency = Currency::first();

        return view("backend.currency.index", compact("currency"));
    }

    public function editOrUpdate(Request $request)
    {
        $id = $request->currencyId;
        $currency = Currency::find($id);
        if (!$currency) {
            Currency::create([
                'kyat' => intval($request->kyat),
                'baht' => floatval($request->baht)
            ]);
        } else {
            Currency::where('id', $id)->update([
                'kyat' => intval($request->kyat),
                'baht' => floatval($request->baht)
            ]);
        }
        return response()->json(['status' => 1]);
    }
}
