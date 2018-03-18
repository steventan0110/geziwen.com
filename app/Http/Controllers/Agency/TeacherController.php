<?php

namespace App\Http\Controllers\Agency;

use App\Agency\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function view(Request $request, $id) {
        $teacher = Teacher::findOrFail($id);
        return view('agency.teacher', compact('teacher', $teacher));
    }
}
