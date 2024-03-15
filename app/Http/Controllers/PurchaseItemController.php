<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class PurchaseItemController extends Controller
{
    public function index()
    {
        return PurchaseItem::all();
    }

    public function show($purchase_number, $product_id)
    {
        $purchaseItem = PurchaseItem::where('purchase_number',  $purchase_number, 'and')
            ->where('product_id',  $product_id)
            //->first();
            ->get();
        // return $purchaseItem;

        if ($purchaseItem->isEmpty()) {
            return response()->json(['message' => 'Purchase item nem létezik!'], 404);
        }
        return $purchaseItem[0];
    }

    public function destroy($purchase_number, $product_id)
    {
        try {
            $purchaseItem = PurchaseItem::where('purchase_number', $purchase_number)
                ->where('product_id', $product_id)
                ->delete();

            if (!$purchaseItem) {
                return response()->json(['message' => 'Purchase item nem található!'], 404);
            }

            return response()->json(['message' => 'Purchase item sikeresen törölve!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, $purchase_number, $product_id)
    {
        try {
            $updateItem = PurchaseItem::where('purchase_number', $purchase_number)
                ->where('product_id', $product_id)
                ->update(['quantity' => $request->input('quantity')]);

            if ($updateItem > 0) {
                return response()->json(['message' => 'Purchase item sikeresen updated-elve!'], 200);
            } else {
                return response()->json(['message' => 'Purchase item nem található, vagy már frissítve van.'], 404);
            }
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        //majd késöbb lekezelni bejelentkezett felhasználóra
        //Jelenlegi változat teszteléshez Jó
        $validator = Validator::make($request->all(), [
            'purchase_number' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        DB::beginTransaction();

        try {
            $purchaseItem = new PurchaseItem();
            $purchaseItem->purchase_number = $request->purchase_number;
            $purchaseItem->product_id = $request->product_id;
            $purchaseItem->quantity = $request->quantity;
            $purchaseItem->save();

            $product = Product::find($request->product_id);
            if (!$product) {
                throw new \Exception('Termék nem található!', 404);
            }
            $availableStock = $product->in_stock;

            if ($availableStock < $request->quantity) {
                throw new \Exception('Nincs elég termék a raktáron!', 400);
            }

            $product->in_stock -= $request->quantity;
            $product->save();

            DB::commit();

            return response()->json($purchaseItem, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            $statusCode = $e instanceof \Illuminate\Database\QueryException ? 500 : 400;

            return response()->json(['message' => $e->getMessage()], $statusCode);
        }
    }
}
