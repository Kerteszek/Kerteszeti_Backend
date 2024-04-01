<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function destroy($id)
    {
        // Product::find($id)->delete(); //Nem lehet, így törölni.
        //Soft delete kell

    }

    /* public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->scientific_name = $request->scientific_name;
        $product->status = $request->status;
        $product->type = $request->type;
        $product->color = $request->color;
        $product->unit = $request->unit;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;
        $product->reserved = $request->reserved;
        $product->priority = $request->priority;
        $product->save();
    } */

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->fill($request->only([
            'scientific_name',
            'status',
            'type',
            'color',
            'unit',
            'price',
            'in_stock',
            'reserved',
            'priority'
        ]));

        $product->save();

        return response()->json($product);
    }


    public function store(Request $request)
    {
        $product = new Product();
        $product->scientific_name = $request->scientific_name;
        $product->status = $request->status;
        $product->type = $request->type;
        $product->color = $request->color;
        $product->unit = $request->unit;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;
        $product->reserved = $request->reserved;
        $product->priority = $request->priority;
        $product->save();
    }

    public function frontendTermek()
    {
        return DB::select("SELECT pr.product_id , pr.scientific_name, pl.name,  u.name
                            FROM products pr
                                INNER JOIN plants pl ON pl.scientific_name = pr.scientific_name
                                INNER JOIN units u ON u.unit_id = pr.unit");
    }

    public function frontendTermekKeppel()
    {
        return DB::select("SELECT pr.product_id , pr.scientific_name, pl.name,  u.name, p.picture_path
                            FROM products pr
                                INNER JOIN plants pl ON pl.scientific_name = pr.scientific_name
                                INNER JOIN units u ON u.unit_id = pr.unit
                                INNER JOIN pictures p ON p.product = pr.product_id
                                ");
    }

    public function konkretTermekKeppel($termek_id)
    {
        return DB::select("SELECT pr.product_id , pr.scientific_name, pl.name,  u.name, p.picture_path
                            FROM products pr
                                INNER JOIN plants pl ON pl.scientific_name = pr.scientific_name
                                INNER JOIN units u ON u.unit_id = pr.unit
                                INNER JOIN pictures p ON p.product = pr.product_id
                                WHERE pr.product_id = $termek_id
                                ");
    }
}
