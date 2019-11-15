<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Karyawan;
use App\User;
use HCrypt;
use Redis;

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

        $karyawan = karyawan::find($id);
        $user_id = $karyawan->user_id;
        $user = user::findOrFail($user_id);
        if (!$user) {
            return $this->returnController("error", "failed find data karyawan");
        }

        $u_user = $user->update($req->all());
        $u_karyawan = $karyawan->update($req->all());
        if (!$u_user && $u_karyawan) {
            return $this->returnController("error", "failed find data karyawan");
        }
        $merge = (['user' => $u_user, 'karyawan' => $u_karyawan]);

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
