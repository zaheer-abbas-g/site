<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        return view('frontend.blog');
    }

    public function singleBlog()
    {
        return view('frontend.single_blog');
    }
}
