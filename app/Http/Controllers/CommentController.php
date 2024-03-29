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
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
    public function store(Request $request) {
        if($request->body == null){
            return response("评论不能为空", 500);
        }
        else if($request->rate == null) {
            return response("您必须要进行评分", 500);
        }
        else {
            $comment = new Comment;
            $comment->body = $request->body;
            $comment->commentable_id = $request->commentable_id;
            $comment->commentable_type = $request->commentable_type;
            $comment->user_id = $request->user_id;
            $comment->rate = $request->rate;
            $comment->save();
            return array($comment->id, $comment->created_at);
        }
    }

    public function delete(Request $request) {
        $id = $request->id;
        Comment::where('id', $id)->delete();
    }

    public function get(Request $request) {
        $type = $request->commentable_type;
        $id = $request->commentable_id;
        $comment_user = array();
        $comment_body = array();
        $rate_arr = array();
        $comment_id = array();
        $comment_date = array();
        $comments = Comment::where(['commentable_type'=>$type, 'commentable_id'=>$id])->get();
        foreach ($comments as $comment) {
            array_push($comment_body, $comment->body);
            array_push($comment_user, $comment->user->name);
            array_push($rate_arr, $comment->rate);
            array_push($comment_id, $comment->id);
            array_push($comment_date, $comment->created_at);
        }
        $sum = 0;
        $num = count($rate_arr);
        foreach ($rate_arr as $rate) {
            $sum += $rate;
        }
        return array($comment_user, $comment_body, $rate_arr, $comment_id, $comment_date, $sum, $num);
    }
}