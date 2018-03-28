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
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
    public function storeTeacherComment(Request $request) {
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->commentable_id = $request->commentable_id;
        $comment->commentable_type = 'teachers';
        $comment->rate = $request->rate;
        $comment->save();
    }

    public function deleteTeacherComment(Request $request) {
        $id = $request->id;
        Comment::where('id', $id)->delete();
    }

    public function getTeacherComment(Request $request) {
        $comment_user = array();
        $comment_body = array();
        $rate_arr = array();
        $comment_id = array();
        $comments = DB::select('select * from comments where commentable_type = ?', ['teachers']);
        foreach ($comments as $comment) {
            array_push($comment_body,$comment->body);
            array_push($comment_user,$comment->username);
            array_push($rate_arr,$comment->rate);
            array_push($comment_id,$comment->id);
        }
        return array($comment_user,$comment_body,$rate_arr,$comment_id);
    }

    public function storeAgencyComment(Request $request) {
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->commentable_id = $request->commentable_id;
        $comment->commentable_type = 'agencies';
        $comment->rate = $request->rate;
        $comment->save();
    }

    public function deleteAgencyComment(Request $request) {
        $id = $request->id;
        Comment::where('id', $id)->delete();
    }

    public function getAgencyComment(Request $request) {
        $comment_user = array();
        $comment_body = array();
        $rate_arr = array();
        $comment_id = array();
        $comments = DB::select('select * from comments where commentable_type = ?', ['agencies']);
        foreach ($comments as $comment) {
            array_push($comment_body,$comment->body);
            array_push($comment_user,$comment->username);
            array_push($rate_arr,$comment->rate);
            array_push($comment_id,$comment->id);
        }
        return array($comment_user,$comment_body,$rate_arr,$comment_id);
    }
}