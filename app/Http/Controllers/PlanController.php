<?php

namespace App\Http\Controllers;

use App\Agency\Service\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function view(Request $request, $id) {
        $plan = Plan::findOrFail($id);
        $plan->applicants = $plan->applicants()->limit(5)->get();
        return view('plan.show', compact('plan', $plan));
    }
}
