<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infringe extends Model
{
  public $table = 'infringe';
  public $fillable=['status','user_id'];
   
   public function user(){
   	return $this->belongsTo('App\User');
   }
}
