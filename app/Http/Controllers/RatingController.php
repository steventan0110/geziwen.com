<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/24
 * Time: 9:03
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating\Rating;
use App\Http\Controllers\Controller;


class RatingController extends Controller
{
    public function storeTeacherRating(Request $request) {
        /*
         * TODO: Throw out exception when $request->rate==null
         */
        $rating = new Rating;
        $rating->rate = $request->rate;
        $rating->rateable_id = $request->rateable_id;
        $rating->rateable_type = 'teachers';
        $rating->save();
    }

    public function storeAgencyRating(Request $request) {
        /*
         * TODO: Throw out exception when $request->rate==null
         */
        $rating = new Rating;
        $rating->rate = $request->rate;
        $rating->rateable_id = $request->rateable_id;
        $rating->rateable_type = 'agencies';
        $rating->save();
    }
}