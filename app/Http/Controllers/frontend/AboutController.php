<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function about()
    {
        return view('frontend.about');
    }


    public function team()
    {
        return view('frontend.team');
    }

    public function testimonials()
    {
        return view('frontend.testimonials');
    }
}
