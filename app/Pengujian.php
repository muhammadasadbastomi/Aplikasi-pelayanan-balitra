<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengujian extends Model
{
    // protected $fillable = ['uuid','kode_jenis', 'jenis'];
    protected $hidden = ['id','permohonan_id','user_id'];

    public function permohonan(){
        return $this->BelongsTo('App\Permohonan');
      }

    public function user(){
        return $this->BelongsTo('App\User');
      }   
}
