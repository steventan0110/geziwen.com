<?php

namespace App;

use App\Agency\Agency;
use Illuminate\Notifications\Notifiable;
use app\Comment\Comment;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'link', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'link');
    }


    public function agencies()
    {
        return $this->hasMany(Agency::class, 'manager_id');
    }
}