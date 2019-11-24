<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Karyawan;
use App\User;
use HCrypt;

class KaryawanController extends APIController
{
    public function get(){
        $karyawan = json_decode(redis::get("karyawan::all"));
        if (!$karyawan) {
            $karyawan = karyawan::all();
            if (!$karyawan) {
                return $this->returnController("error", "failed get karyawan data");
            }
            Redis::set("karyawan:all", $karyawan);
        }
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
        $karyawan = $user->karyawan()->create($req->all());
        if (!$user && $karyawan) {
            return $this->returnController("error", "failed create data karyawan");
        }

        $merge = (['user' => $user, 'karyawan' => $karyawan]);
        Redis::del("karyawan:all");
        return $this->returnController("ok", $merge);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pelanggan = pelanggan::findOrFail($id);
        $user_id = $pelanggan->user_id;
        $user = User::findOrFail($user_id);
        if (!$user){
                return $this->returnController("error", "failed find data pelanggan");
            }
        if($req->foto != null){
                $FotoExt  = $req->foto->getClientOriginalExtension();
                $FotoName = $req->user_id.' - '.$req->name;
                $foto   = $FotoName.'.'.$FotoExt;
                $req->foto->move('images/user', $foto);
                $user->foto       = $foto;
                }else {
                    $user->foto  = $user->foto;
                }
            $user->name            = $req->name;
            $user->email    = $req->email;
            if($req->password != null){
            $password       = Hash::make($req->password);
            $user->password = $password;
            }else{

            }

           $user->update();
           $pelanggan->NIP     = $req->NIP;
           $pelanggan->tempat_lahir    = $req->tempat_lahir;
           $pelanggan->tanggal_lahir    = $req->tanggal_lahir;
           $pelanggan->alamat    = $req->alamat;
           $pelanggan->telepon    = $req->telepon;
           $pelanggan->update();
        if (!$user && $karyawan) {
            return $this->returnController("error", "failed find data karyawan");
        }
        $merge = (['user' => $user, 'karyawan' => $karyawan]);

        Redis::del("user:all");
        Redis::set("user:$user_id", $u_user);
        Redis::del("karyawan:all");
        Redis::set("karyawan:$id", $u_karyawan);

        return $this->returnController("ok", $merge);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $karyawan = karyawan::find($id);
        $user = user::find($karyawan->user_id);
        if (!$user) {
            return $this->returnController("error", "failed find data karyawan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)

        $delete = $user->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data karyawan");
        }

        Redis::del("user:all");
        Redis::del("user:$karyawan->user_id");

        return $this->returnController("ok", "success delete data karyawan");
    }


}
