<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function services()
    {
        return view('frontend.services');
    }
    public function portfolio()
    {
        return view('frontend.portfolio');
    }



    public function getHome(Request $request)
    {

        $data['brand'] = Brand::select('id', 'brand_name', 'brand_image')->orderBy('id')->get();

        return response()->json($data);
    }
}
