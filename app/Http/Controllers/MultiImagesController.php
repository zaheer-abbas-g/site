<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MultiImagesController extends Controller
{
    public function index()
    {
        return view('admin.multipleimages');
    }

    public function store(Request $request)
    {

        if ($request->hasFile('multipleImages')) {

            $images = $request->multipleImages;

            $data = [];
            foreach ($images as $key => $image) {
                $data['imageNames'][$key] = $image;
            }
            return response()->json($data);
        }
    }
}
