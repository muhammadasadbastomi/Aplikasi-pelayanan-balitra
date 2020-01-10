<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    
    public function permohonan(){
        return $this->belongsTo('App\Permohonan');
      }

}
