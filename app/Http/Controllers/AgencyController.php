<?php

namespace App\Http\Controllers;

use App\Agency\Agency;
use Illuminate\Http\Request;
use App\Comment\AgencyComment;

class AgencyController extends Controller
{
    public function view(Request $request, $id) {
        $agency = Agency::findOrFail($id);
        return view('agency.view', compact('agency', $agency));
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
