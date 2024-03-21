<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BasketItem;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BasketItemController extends Controller
{
    public function index()
    {
        return BasketItem::all();
    }

    public function show($basket, $product)
    {
        try {
            $basketItem = BasketItem::where('basket', $basket)
                ->where('product', $product)
                ->first();

            if ($basketItem === null) {
                return response()->json(['message' => 'Keresett BasketItem nem található'], 404);
            }
            return $basketItem;
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($basket, $product)
    {
        try {
            $oldAmount = DB::table('basket_items')
                ->where('basket', $basket)
                ->where('product', $product)
                ->value('amount');

            if ($oldAmount === null) {
                return response()->json(['message' => 'Keresett BasketItem nem található'], 404);
            }
            DB::table('products')
                ->where('product_id', $product) //jót talál
                ->update([

                    'in_stock' => DB::raw("in_stock + " . $oldAmount),
                    'reserved' => DB::raw("reserved  - " . $oldAmount)
                ]);

            BasketItem::where('basket', $basket)
                ->where('product', $product)
                ->delete();

            return response()->json(['message' => 'Basket item sikeresen törölve!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $basket, $product)
    {
        try {
            $oldAmount = DB::table('basket_items')
                ->where('basket', $basket)
                ->where('product', $product)
                ->value('amount');

            $newAmount = $request->input('amount');

            if ($oldAmount === null) {
                return response()->json(['message' => 'Keresett BasketItem nem található'], 404);
            }
            DB::table('products')
                ->where('product_id', $product) //jót talál
                ->update([

                    'in_stock' => DB::raw("in_stock + " . $oldAmount . " - $newAmount"),
                    'reserved' => DB::raw("reserved + " . $newAmount . " - $oldAmount")
                ]);

            DB::table('basket_items')
                ->where('basket', $basket)
                ->where('product', $product)
                ->update(['amount' => $request->input('amount')]); //ezt jól változtatja 

            return response()->json(['message' => 'Basket item sikeresen frissitve!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $basketItem = new BasketItem();
            $basketItem->basket = $request->input('basket');
            $basketItem->product = $request->input('product');
            $basketItem->amount = $request->input('amount');
            $basketItem->save();

            return response()->json(['message' => 'Új termék hozzáadva a BasketItem-hez!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
