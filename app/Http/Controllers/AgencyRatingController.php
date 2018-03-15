<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgencyRatingController extends Controller
{
    //
    public function getTotalRating()
    {
        $ratings = DB::table('agency_ratings')->get();
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
