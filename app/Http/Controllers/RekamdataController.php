<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekamdataController extends Controller
{
    public function index(){
        return view('page.rekam-data.index');
    }
}
