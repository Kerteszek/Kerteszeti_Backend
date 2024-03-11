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

    /* public function store(Request $request)
    {
        $purchaseItem = new PurchaseItem();
        $purchaseItem->purchase_number = $request->purchase_number;
        $purchaseItem->product_id = $request->product_id;
        $purchaseItem->quantity = $request->quantity;
        $purchaseItem->save();
    } */

    public function store(Request $request)
    {
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
