<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    public function index()
    {
        return ProductPrice::all();
    }

    public function show($id)
    {
        return ProductPrice::find($id);
    }

    public function destroy($id)
    {
        ProductPrice::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $product_prices = ProductPrice::find($id);
        $product_prices->new_price = $request->new_price;
        $product_prices->save();
    }

    public function store(Request $request)
    {
        $product_prices = new ProductPrice();
        $product_prices->new_price = $request->new_price;
        $product_prices->save();
    }
}
