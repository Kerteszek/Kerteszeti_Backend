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
        $plant->scientific_name = $request->scientific_name;
        $plant->name = $request->name;
        $plant->plant_category = $request->plant_category;
        $plant->save();
    }

    public function store(Request $request)
    {
        $plant = new Plant();
        $plant->scientific_name = $request->scientific_name;
        $plant->name = $request->name;
        $plant->plant_category = $request->plant_category;
        $plant->save();
    }
}
