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

    public function update(Request $request, $id)
    {
        $suppliance = Suppliance::find($id);
        $suppliance->suppliance_date = $request->suppliance_date;
        $suppliance->number_of_items = $request->number_of_items;
        $suppliance->purchase_price = $request->purchase_price;
        $suppliance->save();
    }

    public function store(Request $request)
    {
        $suppliance = new Suppliance();
        $suppliance->suppliance_date = $request->suppliance_date;
        $suppliance->number_of_items = $request->number_of_items;
        $suppliance->purchase_price = $request->purchase_price;
        $suppliance->save();
    }
}
