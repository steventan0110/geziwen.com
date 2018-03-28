<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/13
 * Time: 10:39
 */
namespace App\Agency;

use Illuminate\Database\Eloquent\Model;
use App\Agency\Agency;
use App\Applicant\Applicant;
use App\Comment\Comment;

class Teacher extends Model
{
    protected $table = "teachers";

    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    public function student() {
        return $this->belongsToMany(Applicant::class,'teachers_applicants','applicant_id','teacher_id');
    }

    public function comments() {
        return $this->morphMany('App\Comment\Comment','commentable');
    }

    public function addComment($body) {
        $this->comments()->create(compact('body'));
    }
}
