<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use HCrypt;

class Pelayanan extends Model
{
    protected $fillable = ['uuid','name', 'price'];
    protected $hidden = ['id'];

    public function setUuidAttribute()
    {
        $uuid = HCrypt::encrypt($this->id);
        dd($uuid);
        $this->attributes['uuid'] = HCrypt::encrypt($value);
    }
}
