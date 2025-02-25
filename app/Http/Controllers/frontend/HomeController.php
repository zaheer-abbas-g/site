<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Service;
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

        $data['about'] = About::orderBy('id')->get()->first();
        $data['brand'] = Brand::select('id', 'brand_name', 'brand_image')->orderBy('id')->get();
        $data['service'] = Service::orderBy('id')->get();
        $data['clients'] = Client::orderBy('id')->get();

        return response()->json($data);
    }
}
