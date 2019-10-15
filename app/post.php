<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public $fillable=['title','address','content','area','price','status','electric','water','id_district','id_ward'];

    public function district(){
    	return $this->belongsTo('App\District','id_district');
    }

    public function ward(){
    	return $this->belongsTo('App\ward','id_ward');
    }
    public function images(){
    	return $this->hasMany('App\Image');
    }
    
    public function userPosts(){
        return $this->belongsToMany('App\User','postUser','post_id','user_id')->withPivot('name','phone','address')->withTimestamps();
    }

    public function userRents(){
        return $this->belongsToMany('App\User','renthouse','post_id','user_id')->withPivot('status')->withTimestamps();
    }
}
