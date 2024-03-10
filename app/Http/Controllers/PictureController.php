<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function index()
    {
        return Picture::all();
    }

    public function show($id)
    {
        return Picture::find($id);
    }

    public function destroy($id)
    {
        Picture::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        $pictures = Picture::find($id);
        //$pictures->picture_path = $request->picture_path;
        $pictures->save();
    }

    public function store(Request $request)
    {
        $pictures = new Picture();
       // $pictures->picture_path = $request->picture_path;
        $pictures->save();
    }
}
