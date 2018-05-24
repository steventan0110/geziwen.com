<?php

namespace App\Http\Controllers;

use App\Agency\Agency;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', ['user' => \Auth::user()]);
    }

    public function welcome()
    {
        return view('welcome');
    }
}
