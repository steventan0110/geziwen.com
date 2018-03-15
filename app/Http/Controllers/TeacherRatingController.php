<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherRatingController extends Controller
{
    //
    public function getTotalRating()
    {
        $ratings = DB::table('teacher_ratings')->get();
        $totalRating = 0;
        $count = 0;


        foreach ($ratings as $rating) {
            $totalRating += $rating;
            $count ++;
        }

        $result=$totalRating/$count;

        return $result;

    }
}
