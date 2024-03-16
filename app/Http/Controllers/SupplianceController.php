<?php

namespace App\Http\Controllers;

use App\Models\Suppliance;
use Illuminate\Http\Request;

class SupplianceController extends Controller
{
    public function index()
    {
        return Suppliance::all();
    }

    public function show($product, $suppliance_date)
    {
        return Suppliance::where('product', $product)
            ->where('suppliance_date', $suppliance_date)
            ->first();
    }

    public function destroy($product, $suppliance_date)
    {
        try {
            $deleted = Suppliance::where('product', $product)
                ->where('suppliance_date', $suppliance_date)
                ->delete();

            if ($deleted === 0) {
                return response()->json(['message' => 'Beszerzési item nem található!'], 404);
            }

            return response()->json(['message' => 'Beszerzési item sikeresen törölve!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, $product, $suppliance_date)
    {
        $suppliance = Suppliance::find($product,  $suppliance_date);
        $suppliance->product = $request->product;
        $suppliance->suppliance_date = $request->$suppliance_date;
        $suppliance->number_of_items = $request->number_of_items;
        $suppliance->purchase_price = $request->purchase_price;
        $suppliance->save();
    }

    public function store(Request $request)
    {
        $suppliance = new Suppliance();
        $suppliance->product = $request->product;

        if ($request->has('suppliance_date')) {
            $suppliance->suppliance_date = $request->suppliance_date;
        } else {
            $suppliance->suppliance_date = now();
        }

        $suppliance->number_of_items = $request->number_of_items;
        $suppliance->purchase_price = $request->purchase_price;

        $suppliance->save();
    }
}
