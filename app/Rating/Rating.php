<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/20
 * Time: 15:29
 */

namespace App\Rating;


use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function rateable() {
        return $this->morphTo();
    }
}