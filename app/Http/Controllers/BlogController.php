<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return view('page.blog.data-blog');
    }

    public function create(){
        return view('page.blog.create-blog');
    }
}
