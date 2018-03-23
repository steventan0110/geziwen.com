<?php
/**
 * Created by PhpStorm.
 * User: asus
<<<<<<< HEAD
 * Date: 2018/3/23
 * Time: 16:42
=======
 * Date: 2018/3/20
 * Time: 15:29
>>>>>>> fbcbedda4dac79429eefe244b1edf7184e0a63c5
 */

namespace App\Rating;


use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function rateable() {
        return $this->morphTo();
    }
}