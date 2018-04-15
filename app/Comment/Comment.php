<?php
/**
 * Created by PhpStorm.
 * User: asus
<<<<<<< HEAD
 * Date: 2018/3/23
 * Time: 16:45
=======
 * Date: 2018/3/20
 * Time: 14:19
>>>>>>> fbcbedda4dac79429eefe244b1edf7184e0a63c5
 */

namespace App\Comment;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    public function commentable() {
        return $this->morphTo();
    }

    public function user() {
        //Strange: The parameter below must be named 'App\User', else laravel can't find app\User if it is named User::class
        return $this->belongsTo('App\User');
    }
}