<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $fillable = ['uuid','kode_jenis', 'jenis'];

    public function jenispelayanan(){
        return $this->BelongsTo('App\JenisPelayanan');
      }

    public function user(){
        return $this->BelongsTo('App\User');
      }   

    public function detail_permohonan()
    {
    	return $this->hasMany('App\Detail_permohonan');
    }

    public function inbox()
    {
    	return $this->hasMany('App\Inbox');
    }

    public function pengujian(){
      return $this->HasOne('App\Pengujian');
    }   

}
