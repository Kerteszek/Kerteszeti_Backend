<?php

namespace App\Http\Controllers;

use App\Models\DiscountedItem;
use Illuminate\Http\Request;

class DiscountedItemController extends Controller
{
    public function index()
    {
        return DiscountedItem::all();
    }

    public function show($id)
    {
        return DiscountedItem::find($id);
    }

    public function destroy($id)
    {
        DiscountedItem::find($id)->delete();
    }
}
