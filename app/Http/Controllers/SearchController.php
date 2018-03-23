<?php

namespace App\Http\Controllers;

use App\Agency\Agency;
use App\Agency\Service\Plan;
use App\Applicant\Applicant;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function result(Request $request) {
        return view('search', ['q' => $request->get('q')]);
    }
}
