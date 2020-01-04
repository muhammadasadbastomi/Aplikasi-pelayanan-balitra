<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $fillable = ['uuid','kode_jenis', 'jenis'];
    protected $hidden = ['id','jenispelayanan_id','user_id'];

    public function jenis_pelayanan(){
        return $this->BelongsTo('App\JenisPelayanan');
      }  

    public function detail_permohonan()
    {
    	return $this->belongsToMany('App\Detail_permohonan');
    }
}
