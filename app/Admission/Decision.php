<?php

namespace App\Admission;

use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    protected $table = "decisions";

    public function applications() {
        return $this->hasMany(Application::class);
    }
}
