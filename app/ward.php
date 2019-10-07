<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ward extends Model
{
    public $table = "wards";
    public $fillable = ['name'];

    public function post(){
    	return $this->hasMany('App\post');
    }
}
