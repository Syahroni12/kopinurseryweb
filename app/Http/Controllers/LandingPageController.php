<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        return view('page.landing-page.index');
    }

    public function about(){
        return view('page.landing-page.about');
    }

    public function service(){
        return view('page.landing-page.service');
    }

    public function contact(){
        return view('page.landing-page.contact');
    }
}
