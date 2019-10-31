<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Karyawan;
use App\User;
use HCrypt;
use Redis;
// use Hash;

class KaryawanController extends APIController
{
    public function get(){
        $karyawan = Redis::get("karyawan:all");
        if (!$karyawan) {
            $karyawan = karyawan::all();
            if (!$karyawan) {
                return $this->returnController("error", "failed get karyawan data");
            }
            Redis::set("karyawan:all", $karyawan);

        }
        // dd($karyawan);
        return $this->returnController("ok", $karyawan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $karyawan = Redis::get("karyawan:$id");
        if (!$karyawan) {
            $karyawan = karyawan::find($id);
            if (!$karyawan){
                return $this->returnController("error", "failed find data karyawan");
            }
            Redis::set("karyawan:$id", $karyawan);
        }

        return $this->returnController("ok", $karyawan);
    }

    public function create(Request $req){

        $user = User::create($req->all());
        // dd($user->id);
        $karyawan = $user->karyawan()->create($req->all());
        // $id = HCrypt::decrypt($user->id);
        // $id =
         // dd($);


        if (!$user && $karyawan) {
            return $this->returnController("error", "failed create data karyawan");
        }


        $merge = (['user' => $user, 'karyawan' => $karyawan]);
        Redis::del("karyawan:all");
        // Redis::set("pelayanan:$id", $update);

        return $this->returnController("ok", $merge);
    }
}
