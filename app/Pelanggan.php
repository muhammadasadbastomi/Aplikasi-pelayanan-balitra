<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use HCrypt;

class Pelanggan extends Model
{
    protected $fillable = [
        'kd_pelanggan', 'alamat',  'telepon'
    ];

}
