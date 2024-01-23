<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        return Discount::all();
    }

    public function show($id)
    {
        return Discount::find($id);
    }

    public function destroy($id)
    {
        Discount::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::find($id);
        $discount->percentage = $request->percentage;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->save();
    }

    public function store(Request $request)
    {
        $discount = new Discount();
        $discount->percentage = $request->percentage;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->save();
    }
}
