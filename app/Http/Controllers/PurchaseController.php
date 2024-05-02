<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $purchase->buyer = $request->buyer;
        $purchase->shopping_date = $request->shopping_date;
        $purchase->grand_total = $request->grand_total;
        $purchase->save();
    }

    public function store(Request $request)
    {
        $purchase = new Purchase();
        $purchase->buyer = $request->buyer;
        $purchase->shopping_date = $request->shopping_date;
        $purchase->grand_total = $request->grand_total;
        $purchase->save();
    }

    /*  public function aktualisVasarlas($user_id, $datum)
    {
        return DB::select("SELECT purchase_number
        FROM purchases            
            WHERE buyer = $user_id and shopping_date LIKE  $datum
           
            ");
    } */

    public function aktualisVasarlas($user_id)
    {
        return DB::select("SELECT purchase_number , buyer, shopping_date
                      FROM purchases            
                      WHERE buyer = $user_id
                      ORDER BY shopping_date DESC
                      LIMIT 1");
    }
}
