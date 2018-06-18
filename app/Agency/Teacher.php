<?php
namespace App\Agency;

use Illuminate\Database\Eloquent\Model;
use App\Applicant\Applicant;
use App\Comment\Comment;
use Laravel\Scout\Searchable;

class Teacher extends Model
{
    use Searchable;

    protected $table = "teachers";

    protected $fillable = ["name", "introduction", "subject", "years_of_teaching"];

    public function searchableAs() {
        return config('scout.prefix') . 'teachers';
    }

    public function toSearchableArray() {
        $teacher = $this->toArray();
        $teacher['agency'] = [
            'name' => $this->agency->name,
            'introduction' => $this->agency->introduction,
            'thumbnail' => $this->agency->thumbnail,
            'logo' => $this->agency->logo
        ];
        unset($teacher['created_at'], $teacher['updated_at'], $teacher['agency_id']);
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
