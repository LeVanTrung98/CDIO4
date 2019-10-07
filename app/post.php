<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public $fillable=['title','address','content','area','price','status','electric','water','id_ward','id_district'];

    public function district(){
    	return $this->hasOne('App\District');
    }

    public function award(){
    	return $this->hasOne('App\Award');
    }
    public function images(){
    	return $this->hasMany('App\Image');
    }
    
    public function userPosts(){
        return $this->belongsToMany('App\User','postUser','post_id','user_id')->withPivot('name','phone','address')->withTimestamps();
    }
}
