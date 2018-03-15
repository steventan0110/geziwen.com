<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/14
 * Time: 14:44
 */
namespace App\Comment;

use Illuminate\Database\Eloquent\Model;
use App\Teacher\Teacher;

class TeacherComment extends Model
{
    protected $table = "teacher_comments";

    public function teachers() {
        return $this->belongsTo(Teacher::class);
    }

}