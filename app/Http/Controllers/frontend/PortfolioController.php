<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function portfolio()
    {
        return view('frontend.portfolio');
    }

    public function portfolioDetails()
    {
        return view('frontend.portfolio_details');
    }
}
