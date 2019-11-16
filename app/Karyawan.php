<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use HCrypt;

class Karyawan extends Model
{
    protected $fillable = [
        'NIP', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telepon'
    ];
    protected $hidden = [
        'id', 'user_id'
    ];
    protected $appends = array('uuid');

    public function getUuidAttribute()
    {
        return HCrypt::encrypt($this->id);
    }

    public function user(){
      return $this->HasOne('App\User');
    }
}