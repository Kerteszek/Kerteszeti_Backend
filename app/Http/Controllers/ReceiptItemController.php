<?php

namespace App\Http\Controllers;

use App\Models\ReceiptItem;
use Illuminate\Http\Request;

class ReceiptItemController extends Controller
{
    public function index()
    {
        return ReceiptItem::all();
    }

    public function show($id)
    {
        return ReceiptItem::find($id);
    }

    public function destroy($id)
    {
        ReceiptItem::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $receiptItem = ReceiptItem::find($id);
        $receiptItem->number_of_items = $request->number_of_items;        
        $receiptItem->save();
    }

    public function store(Request $request)
    {
        $receiptItem = new ReceiptItem();
        $receiptItem->number_of_items = $request->number_of_items;  
        $receiptItem->save();
    }
}
