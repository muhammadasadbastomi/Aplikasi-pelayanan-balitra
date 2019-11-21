<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelanggan;
use HCrypt;

class PelangganController extends APIController
{
    public function get(){
        $pelanggan = Redis::get("pelanggan:all");
        if (!$pelanggan) {
            $pelanggan = pelanggan::all();
            if (!$pelanggan) {
                return $this->returnController("error", "failed get pelanggan data");
            }
            Redis::set("pelanggan:all", $pelanggan);
        }
        return $this->returnController("ok", $pelanggan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pelanggan = Redis::get("pelanggan:$id");
        if (!$pelanggan) {
            $pelanggan = pelanggan::find($id);
            if (!$pelanggan){
                return $this->returnController("error", "failed find data pelanggan");
            }
            Redis::set("pelanggan:$id", $pelanggan);
        }
        return $this->returnController("ok", $pelanggan);
    }

    public function create(Request $req){
        $user_id= Auth::user()->id;
        $create = new Pelanggan;
        
        $create->kd_pelanggan     = $req->kd_pelanggan;
        $create->alamat    = $req->alamat;
        $create->telepon    = $req->telepon;
        $create->user_id    = $user_id;
        $create->save();

        $id= $create->id;
        $uuid = HCrypt::encrypt($id);
        $setuuid = Pelanggan::findOrFail($id);
        $setuuid->uuid = $uuid;
        $setuuid->update();

        if (!$create) {
            return $this->returnController("error", "failed create data pelanggan");
        }

        Redis::del("pelanggan:all");
        return $this->returnController("ok", $create);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pelanggan = pelanggan::find($id);
        $user_id = $pelanggan->user_id;
        $user = user::findOrFail($user_id);
        if (!$user) {
            return $this->returnController("error", "failed find data pelanggan");
        }

        $u_user = $user->update($req->all());
        $u_pelanggan = $pelanggan->update($req->all());
        if (!$u_user && $u_pelanggan) {
            return $this->returnController("error", "failed find data pelanggan");
        }
        $merge = (['user' => $u_user, 'pelanggan' => $u_pelanggan]);

        Redis::del("user:all");
        Redis::set("user:$user_id", $u_user);
        Redis::del("pelanggan:all");
        Redis::set("pelanggan:$id", $u_pelanggan);

        return $this->returnController("ok", $merge);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pelanggan = pelanggan::find($id);
        $user = user::find($pelanggan->user_id);
        if (!$user) {
            return $this->returnController("error", "failed find data pelanggan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)

        $delete = $user->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pelanggan");
        }

        Redis::del("user:all");
        Redis::del("user:$pelanggan->user_id");

        return $this->returnController("ok", "success delete data pelanggan");
    }
}
