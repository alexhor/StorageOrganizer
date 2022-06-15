<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Main homepage
     */
    public function home() {
      return view('pages.home');
    }
}
