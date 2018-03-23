<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/23
 * Time: 16:45
 */

namespace App\Comment;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function commentable() {
        return $this->morphTo();
    }
}