<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $table = "districts";
    public $fillable=['name'];

    public function posts(){
    	return $this->hasMany('App\post');
    }
}
