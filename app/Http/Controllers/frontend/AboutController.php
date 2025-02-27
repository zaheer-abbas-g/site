<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Client;
use App\Models\Skill;
use App\Models\Team;
use App\Models\Testimonials;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function about()
    {
        $about['about'] =  About::orderBy('id')->get()->first();
        $about['team'] =  Team::orderBy('id')->get();
        $about['team']['team_description'] =  "Hello Team Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.";
        $about['client'] =  Client::orderBy('id')->get();

        return view('frontend.about', compact('about'));
    }
    public function getSkills()
    {
        $about['skill'] =  Skill::orderBy('id')->get();
        $about['skill']['title'] =   "Zaheer Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.";
        return response()->json(['data' => $about], 200);
    }

    public function team()
    {

        $about['team'] =  Team::orderBy('id')->get();
        $about['team_description']['team'] =  "Hello Team Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.";
        return view('frontend.team', compact('about'));
    }

    public function testimonials()
    {
        $testimonials['getTestimonials'] = Testimonials::orderBy('id')->get();
        return view('frontend.testimonials', compact('testimonials'));
    }
}
