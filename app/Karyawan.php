<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';

    public function user(){
      return $this->belongsTo('App\User');
    }
}
