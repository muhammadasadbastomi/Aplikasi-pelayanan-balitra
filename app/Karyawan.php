<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = ['NIP', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telepon'];

    public function user(){
      return $this->belongsTo('App\User');
    }
}
