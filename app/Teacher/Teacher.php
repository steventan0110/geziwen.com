<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/13
 * Time: 10:39
 */
namespace App\Teacher;

use App\Rating\TeacherRating;
use Illuminate\Database\Eloquent\Model;
use App\Agency\Agency;
use App\Applicant\Applicant;
use App\Comment\TeacherComment;

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
        return $this->hasMany(TeacherComment::class);
    }

    public function ratings() {
        return $this->hasMany(TeacherRating::class);
    }

    public function addComment($body) {
        $this->comments()->create(compact('body'));
    }
}
