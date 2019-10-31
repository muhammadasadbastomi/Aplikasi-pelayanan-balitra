<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use HCrypt;
// use Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','id'
    ];

    // protected $hidden   = array('id');
    protected $appends = array('uuid');

    public function getUuidAttribute()
    {
        return HCrypt::decrypt($this->id);
        // return Hash::make($this->id);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setRoleAttribute($value)
    {

            $this->attributes['role'] = 2;


    }

    public function karyawan(){
        return $this->HasOne('App\Karyawan');
      }
}
