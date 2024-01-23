<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index()
    {
        return Receipt::all();
    }

    public function show($id)
    {
        return Receipt::find($id);
    }

    public function destroy($id)
    {
        Receipt::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $recipt = Receipt::find($id);
        $recipt->shopping_date = $request->shopping_date;
        $recipt->grand_total = $request->grand_total;
        $recipt->save();
    }

    public function store(Request $request)
    {
        $recipt = new Receipt();
        $recipt->shopping_date = $request->shopping_date;
        $recipt->grand_total = $request->grand_total;
        $recipt->save();
    }
}
