<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPelayanan extends Model
{
    protected $fillable = ['uuid','kode_jenis', 'jenis'];
    protected $hidden = ['id'];

    public function pelayanan(){
        return $this->HasMany('App\Pelayanan');
      }
}
