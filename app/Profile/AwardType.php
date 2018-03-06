<?php

namespace App\Profile;

use Illuminate\Database\Eloquent\Model;

class AwardType extends Model
{
    protected $table = "award_types";

    public function awards() {
        return $this->hasMany(Award::class);
    }
}
