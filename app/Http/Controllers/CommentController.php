<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/24
 * Time: 9:03
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment\Comment;
use App\Http\Controllers\Controller;


class CommentController extends Controller
{
    public function storeTeacherComment(Request $request) {
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->commentable_id = $request->commentable_id;
        $comment->commentable_type = 'teachers';
        $comment->save();
    }

    public function storeAgencyComment(Request $request) {
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->commentable_id = $request->commentable_id;
        $comment->commentable_type = 'agencies';
        $comment->save();
    }
}