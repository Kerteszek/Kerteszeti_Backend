<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BasketItem;
use Illuminate\Http\Request;

class BasketItemController extends Controller
{
    public function index()
    {
        return BasketItem::all();
    }

    public function show($id)
    {
        return BasketItem::find($id);
    }

    public function destroy($id)
    {
        BasketItem::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $basket_items = BasketItem::find($id);
        $basket_items->amount = $request->amount;
        $basket_items->save();
    }

    public function store(Request $request)
    {
        $basket_items = new BasketItem();
        $basket_items->amount = $request->amount;
        $basket_items->save();
    }
}
