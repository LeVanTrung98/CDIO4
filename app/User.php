<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','status','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function postUsers(){
        return $this->belongsToMany('App\post','postUser','user_id','post_id')->withPivot('name','phone','address')->withTimestamps();
    }

    public function rentPosts(){
        return $this->belongsToMany('App\post','renthouse','user_id','post_id')->withPivot('status')->withTimestamps();
    }
    public function infringes(){
        return $this->hasMany('App\Infringe');
    }
}
