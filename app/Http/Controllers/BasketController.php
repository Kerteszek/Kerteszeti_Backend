<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        return Basket::all();
    }

    public function show($id)
    {

        return Basket::find($id);
    }

    public function destroy($id)
    {
        Basket::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $baskets = Basket::find($id);
        $baskets->user_id = $request->user_id;
        $baskets->save();
    }

    public function store(Request $request)
    {
        $baskets = new Basket();
        $baskets->user_id = $request->user_id;
        $baskets->save();
    }
}
