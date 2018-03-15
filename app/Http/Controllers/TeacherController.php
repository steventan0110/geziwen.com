<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/13
 * Time: 12:31
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher\Teacher;
use App\Comment\TeacherComment;

class TeacherController extends Controller {

    public function view(Request $request, $id) {
        $teacher = Teacher::findOrFail($id);
        return view('teacher.view', [
            'teacher' => $teacher,
            'agency' => $teacher->agency()->get(),
            'student' => $teacher->student()->get(),
            'comments' => $teacher->comments()->get(),
            'ratings' => $teacher->ratings()->getTotalRating()
        ]);
    }

    public function create() {
        return "create";
    }

    public function edit() {
        return "edit";
    }

    public function delete() {
        return "delete";
    }

}