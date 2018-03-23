<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/23
 * Time: 16:42
 */

namespace App\Rating;


use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function rateable() {
        return $this->morphTo();
    }
}