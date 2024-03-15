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

    public function show($id)
    {
        return Suppliance::find($id);
    }

    public function destroy($id)
    {
        Suppliance::find($id)->delete();
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
