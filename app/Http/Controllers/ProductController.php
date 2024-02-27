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
}
