<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Agency\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyController extends Controller
{
    public function view(Request $request, $id) {
        $agency = Agency::findOrFail($id);
        if (Auth::check()) {
            $user = Auth::user();
            return view('agency.view', ['agency'=>$agency, 'user'=>$user]);
        }
        return view('agency.view', ['agency'=>$agency, 'user'=>null]);
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
