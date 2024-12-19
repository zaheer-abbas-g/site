<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
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



    public function clients() {}
}
