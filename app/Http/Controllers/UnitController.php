<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Unit;


class UnitController extends Controller
{
    public function index()
    {
        return Unit::all();
    }

    public function show($id)
    {
        return Unit::find($id);
    }

    public function destroy($id)
    {
        Unit::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $pot = Unit::find($id);
        $pot->name = $request->name;
        $pot->save();
    }

    public function store(Request $request)
    {
        $pot = new Unit();
        $pot->name = $request->name;
        $pot->save();
    }
}
