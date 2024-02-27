<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        return Purchase::all();
    }

    public function show($id)
    {
        return Purchase::find($id);
    }

    public function destroy($id)
    {
        Purchase::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $purchase = Purchase::find($id);
        $purchase->shopping_date = $request->shopping_date;
        $purchase->grand_total = $request->grand_total;
        $purchase->save();
    }

    public function store(Request $request)
    {
        $purchase = new Purchase();
        $purchase->shopping_date = $request->shopping_date;
        $purchase->grand_total = $request->grand_total;
        $purchase->save();
    }
}
