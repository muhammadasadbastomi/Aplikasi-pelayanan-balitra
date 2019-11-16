<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use HCrypt;

class Pelanggan extends Model
{
    protected $fillable = [
        'kd_pelanggan', 'alamat',  'telepon'
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
