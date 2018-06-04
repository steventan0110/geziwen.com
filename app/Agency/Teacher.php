<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/13
 * Time: 10:39
 */
namespace App\Agency;

use Illuminate\Database\Eloquent\Model;
use App\Applicant\Applicant;
use App\Comment\Comment;
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

    public function applicants() {
        return $this->belongsToMany(Applicant::class, 'teachers_applicants');
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected $hidden = ['created_at', 'updated_at', 'id', 'agency_id', 'pivot'];
}
