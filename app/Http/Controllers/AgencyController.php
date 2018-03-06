<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function view(Request $request, $id) {
        $agency = Agency::findOrFail($id);
        return view('agency.view', [
            'agency' => $agency,
            'applicants' => $agency->applicants()->get()
        ]);
    }

    public function edit(Request $request, $id) {
        return "edit";
    }

    public function create(Request $request, $id) {
        return "create";
    }

    public function delete(Request $request, $id) {
        return "delete";
    }
}
