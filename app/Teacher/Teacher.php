<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/13
 * Time: 10:39
 */
namespace App\Teacher;

use Illuminate\Database\Eloquent\Model;
use App\Agency\Agency;
use App\Applicant\Applicant;
use App\Comments;
use PhpParser\Comment;

class Teacher extends Model
{
    protected $table = "teachers";

    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    public function student() {
        return $this->belongsToMany(Applicant::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
