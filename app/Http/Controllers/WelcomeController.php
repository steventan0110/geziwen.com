<?php

namespace App\Http\Controllers;

use App\Agency\Agency;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome() {
        $agencies = Agency::all();
        return view('welcome', ['agencies' => $agencies]);
    }
}
