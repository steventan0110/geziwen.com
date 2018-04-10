<?php

namespace App\Http\Controllers\Agency;

use App\Agency\Service\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function view(Request $request, $id) {
        $plan = Plan::findOrFail($id);
        $plan->applicants = $plan->applicants()->limit(5)->get();
        return view('agency.plan', compact('plan', $plan));
    }
}
