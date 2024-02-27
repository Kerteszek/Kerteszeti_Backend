<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use Illuminate\Http\Request;

class PurchaseItemController extends Controller
{
    public function index()
    {
        return PurchaseItem::all();
    }

    public function show($id)
    {
        return PurchaseItem::find($id);
    }

    public function destroy($id)
    {
        PurchaseItem::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $purchaseItem = PurchaseItem::find($id);
        $purchaseItem->quantity = $request->quantity;
        $purchaseItem->save();
    }

    public function store(Request $request)
    {
        $purchaseItem = new PurchaseItem();
        $purchaseItem->quantity = $request->quantity;
        $purchaseItem->save();
    }
}
