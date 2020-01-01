<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelanggan;
use App\User;
use HCrypt;

class PelangganController extends APIController
{
    public function get(){
        $pelanggan = json_decode(redis::get("pelanggan::all"));
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
        $user = User::create($req->all());
        // hash password
        $password=Hash::make($user->password);
        //set uuid
        $user_id = $user->id;
        $uuid = HCrypt::encrypt($user_id);
        $setuuid = User::findOrFail($user_id);
        $setuuid->uuid = $uuid;
        $setuuid->password = $password;
        if($req->foto != null)
        {
            $img = $req->file('foto');
            $FotoExt  = $img->getClientOriginalExtension();
            $FotoName = $user_id.' - '.$req->username;
            $foto   = $FotoName.'.'.$FotoExt;
            $img->move('img/user', $foto);
            $setuuid->foto       = $foto;
        }else{
            $setuuid->foto       = $setuuid->foto;
        }
        $setuuid->update();

        $pelanggan = $user->pelanggan()->create($req->all());
        //set uuid
        $pelanggan_id = $pelanggan->id;
        $uuid = HCrypt::encrypt($pelanggan_id);
        $setuuid = Pelanggan::findOrFail($pelanggan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$user && $pelanggan) {
            return $this->returnController("error", "failed create data pelanggan");
        }

        $merge = (['user' => $user, 'pelanggan' => $pelanggan]);
        Redis::del("pelanggan:all");
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
                $user->password = $user->password;
            }

           $user->update();
           $pelanggan->kd_pelanggan     = $req->kd_pelanggan;
           $pelanggan->alamat    = $req->alamat;
           $pelanggan->telepon    = $req->telepon;
           $pelanggan->update();

        if (!$user && $pelanggan) {
            return $this->returnController("error", "failed find data pelanggan");
        }
        $merge = (['user' => $user, 'pelanggan' => $pelanggan]);

        Redis::del("user:all");
        Redis::set("user:$user_id", $user);
        Redis::del("pelanggan:all");
        Redis::set("pelanggan:$id", $pelanggan);

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
        $image_path = "img/pelanggan/".$pelanggan->foto;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
        File::delete($image_path);
        }
        $delete = $user->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pelanggan");
        }

        Redis::del("user:all");
        Redis::del("user:$pelanggan->user_id");

        return $this->returnController("ok", "success delete data pelanggan");
    }
}
