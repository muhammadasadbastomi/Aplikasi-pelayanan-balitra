<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use HCrypt;

class Pelayanan extends Model
{
    protected $fillable = ['uuid','name', 'price'];
    protected $hidden = ['id','jenis_pelayanan_id'];

    public function jenis_pelayanan(){
        return $this->BelongsTo('App\JenisPelayanan');
      }    

    public function detail_permohonan()
    {
    	return $this->belongsToMany('App\Detail_permohonan');
    }
}
