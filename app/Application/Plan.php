<?php

namespace App\Application;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = "plans";

    public function applications() {
        return $this->hasMany(Offer::class);
    }
}
