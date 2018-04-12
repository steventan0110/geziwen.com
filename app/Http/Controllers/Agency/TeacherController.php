<?php

namespace App\Http\Controllers\Agency;

use App\Agency\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function view(Request $request, $id) {
        $teacher = Teacher::findOrFail($id);
        if (Auth::check()) {
            $user = Auth::user();
            return view('agency.teacher', ['teacher'=>$teacher, 'user'=>$user]);
        }

        return view('agency.teacher', ['teacher'=>$teacher, 'user'=>null]);
    }
}
