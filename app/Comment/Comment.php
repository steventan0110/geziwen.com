<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/20
 * Time: 14:19
 */

namespace App\Comment;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function commentable() {
        return $this->morphTo();
    }
}