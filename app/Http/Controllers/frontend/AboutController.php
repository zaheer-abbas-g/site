<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Team;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function about()
    {
        $about['about'] =  About::orderBy('id')->get()->first();
        $about['team'] =  Team::orderBy('id')->get();
        $about['team_description'] =  Team::orderBy('id')->get()->first();
        return view('frontend.about', compact('about'));
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
