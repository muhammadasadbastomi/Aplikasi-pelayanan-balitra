<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use HCrypt;

class Pelayanan extends Model
{
    protected $fillable = ['uuid','name', 'price'];
    protected $hidden = ['id','jenis_pelayanan_id','buah_id'];

    public function jenis_pelayanan(){
        return $this->BelongsTo('App\JenisPelayanan');
      }    

    public function buah(){
        return $this->BelongsTo('App\Buah');
      }    

    public function detail_permohonan()
    {
    	return $this->HasMany('App\Detail_permohonan');
    }
}
