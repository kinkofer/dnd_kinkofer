<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkyreachController extends Controller
{
    public function index() {
        return view('skyreach');
    }
}
