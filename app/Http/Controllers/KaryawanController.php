<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index() {
        return view('page.karyawan.data-karyawan');
    }

    public function create() {
        return view('page.karyawan.create-karyawan');
    }
}
