<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use HCrypt;

class Pelayanan extends Model
{
    protected $fillable = ['name', 'price'];

    protected $hidden = [
        'id'
    ];

    protected $appends = array('uuid');

    public function getUuidAttribute()
    {
        // return Hash::make($this->id);
        return HCrypt::encrypt($this->id);
    }
}
