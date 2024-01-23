<?php

namespace App\Http\Controllers;

use App\Models\Pot;
use Illuminate\Http\Request;

class PotController extends Controller
{
    public function index()
    {
        return Pot::all();
    }

    public function show($id)
    {
        return Pot::find($id);
    }

    public function destroy($id)
    {
        Pot::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $pot = Pot::find($id);
        $pot->name = $request->name;
        $pot->save();
    }

    public function store(Request $request)
    {
        $pot = new Pot();
        $pot->name = $request->name;
        $pot->save();
    }
}
