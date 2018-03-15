<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/3/14
 * Time: 14:47
 */

namespace App\Comment;

use Illuminate\Database\Eloquent\Model;
use App\Agency\Agency;

class AgencyComment extends Model
{
    protected $table = "agency_comments";

    public function agencies() {
        return $this->belongsTo(Agency::class);
    }
}