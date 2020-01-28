<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buah extends Model
{
    protected $fillable = ['uuid','name', 'price'];
    protected $hidden = ['id','jenis_pelayanan_id'];

    public function jenis_pelayanan(){
        return $this->BelongsTo('App\JenisPelayanan');
      }    

    public function pelayanan()
    {
    	return $this->HasMany('App\Pelayanan');
    }
}
