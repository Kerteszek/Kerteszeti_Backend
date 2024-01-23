<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        Product::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->pot = $request->pot;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;

        $product->save();
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->pot = $request->pot;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;
        $product->save();
    }
}
