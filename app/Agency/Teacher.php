<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/13
 * Time: 10:39
 */
namespace App\Agency;

use App\Rating\TeacherRating;
use Illuminate\Database\Eloquent\Model;
use App\Agency\Agency;
use App\Applicant\Applicant;
use App\Comment\TeacherComment;
use Laravel\Scout\Searchable;

class Teacher extends Model
{
    use Searchable;

    protected $table = "teachers";

    public function searchableAs() {
        return $this->table."_index";
    }

    public function toSearchableArray() {
        $teacher = $this->toArray();
        $teacher['agency'] = [
            'name' => $this->agency->name,
            'introduction' => $this->agency->introduction
        ];
        unset($teacher['created_at'], $teacher['updated_at'], $teacher['agency_id'], $teacher['picture']);
        return $teacher;
    }

    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    public function student() {
        return $this->belongsToMany(Applicant::class,'teachers_applicants','applicant_id','teacher_id');
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
