<?php

namespace App\Http\Controllers;

use App\Models\PlantCategory;
use Illuminate\Http\Request;

class PlantCategoryController extends Controller
{
    public function index()
    {
        return PlantCategory::all();
    }

    public function show($id)
    {
        return PlantCategory::find($id);
    }

    public function destroy($id)
    {
        PlantCategory::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $plantCategorie = PlantCategory::find($id);
        $plantCategorie->name = $request->name;
        $plantCategorie->ancestor_category = $request->ancestor_category;
        $plantCategorie->save();
    }

    public function store(Request $request)
    {
        $plantCategorie = new PlantCategory();
        $plantCategorie->name = $request->name;
        $plantCategorie->ancestor_category = $request->ancestor_category;
        $plantCategorie->save();
    }
}
