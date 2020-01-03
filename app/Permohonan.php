<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $fillable = ['uuid','kode_jenis', 'jenis'];
    protected $hidden = ['id','jenispelayanan_id','user_id'];

    public function jenispelayanan(){
        return $this->BelongsTo('App\JenisPelayanan');
      }  
}
