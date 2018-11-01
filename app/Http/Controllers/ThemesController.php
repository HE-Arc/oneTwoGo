<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemesController extends Controller
{
    public function showCarousel()
    {
        return view('themes/carousel');
    }
}
