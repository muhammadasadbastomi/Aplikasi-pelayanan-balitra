<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'nama', 'alamat', 'telepon'
     ];
     protected $hidden = [
         'id', 'user_id'
     ];
 
     public function user(){
       return $this->belongsTo('App\User');
     }
}
