<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
    {
        return Plant::all();
    }

    public function show($id)
    {
        return Plant::find($id);
    }

    public function destroy($id)
    {
        Plant::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $plant = Plant::find($id);
        $plant->name = $request->name;
        $plant->ancestor_category = $request->ancestor_category;
        $plant->save();
    }

    public function store(Request $request)
    {
        $plant = new Plant();
        $plant->name = $request->name;
        $plant->ancestor_category = $request->ancestor_category;
        $plant->save();
    }
}
