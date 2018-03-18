<?php

namespace App\Application;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = "admission_universities";

    public function applications() {
        return $this->hasMany(Offer::class);
    }

}
