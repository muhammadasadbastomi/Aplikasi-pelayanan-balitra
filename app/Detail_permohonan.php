<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_permohonan extends Model
{
    protected $hidden = [
        'id','permohonan_id','pelayanan_id',
    ];
    
    public function permohonan()
    {
        return $this->belongsTo('App\Permohonan');
    }

    public function pelayanan()
    {
        return $this->belongsTo('App\Pelayanan');
    }
}
