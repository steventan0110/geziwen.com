<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/14
 * Time: 15:25
 */
namespace App\Http\Controllers;

use App\Comment\AgencyComment;
use App\Comment\TeacherComment;
use App\Agency\Agency;
use Illuminate\Http\Request;

class AgencyCommentController extends Controller
{
    public function store(Agency $agency)
    {
        $this->validate(request(),[
            'body' => 'required|min:5'
        ]);

        $agency->addComment(request('body'));
        return back();
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