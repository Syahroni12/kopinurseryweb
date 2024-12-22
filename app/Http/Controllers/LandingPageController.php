<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){

        $blogs = Blog::all();
        
        return view('page.landing-page.index', compact('blogs'));
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
