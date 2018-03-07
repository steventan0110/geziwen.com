<?php

namespace App\Admission;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = "universities";

    public function applications() {
        return $this->hasMany(Application::class);
    }

}
