<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $table = 'images';
    public $fillable = ['path','post_id'];

    public function post(){
    	return $this->belongsTo('App\post');
    }
}
