<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelayanan;
use HCrypt;

class PelayananController extends APIController
{
    public function get(){
        $pelayanan = json_decode(redis::get("pelayanan::all"));
        if (!$pelayanan) {
            $pelayanan = pelayanan::with('jenispelayanan')->get();
            if (!$pelayanan) {
                return $this->returnController("error", "failed get pelayanan data");
            }
            Redis::set("pelayanan:all", $pelayanan);
        }
        return $this->returnController("ok", $pelayanan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pelayanan = Redis::get("pelayanan:$id");
        if (!$pelayanan) {
            $pelayanan = pelayanan::with('jenispelayanan')->where('id',$id)->first();
            if (!$pelayanan){
                return $this->returnController("error", "failed find data pelayanan");
            }
            Redis::set("pelayanan:$id", $pelayanan);
        }
        return $this->returnController("ok", $pelayanan);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());
        $pelayanan = new pelayanan;
        // decrypt foreign key id
        $pelayanan->jenispelayanan_id = Hcrypt::decrypt($req->jenispelayanan_id);
        $pelayanan->name = $req->name;
        $pelayanan->price = $req->price;

        $pelayanan->save();

        //set uuid
        $pelayanan_id = $pelayanan->id;
        $uuid = HCrypt::encrypt($pelayanan_id);
        $setuuid = pelayanan::findOrFail($pelayanan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$pelayanan) {
            return $this->returnController("error", "failed create data pelayanan");
        }
        Redis::del("pelayanan:all");
        Redis::set("pelayanan:all", $pelayanan);
        return $this->returnController("ok", $pelayanan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pelayanan = pelayanan::findOrFail($id);
        $pelayanan->jenispelayanan_id = Hcrypt::decrypt($req->jenispelayanan_id);
        $pelayanan->name = $req->name;
        $pelayanan->price = $req->price;
        $pelayanan->update();
        if (!$pelayanan) {
            return $this->returnController("error", "failed find data pelayanan");
        }
        $pelayanan = pelayanan::with('jenispelayanan')->where('id',$id)->first();
        Redis::del("pelayanan:all");
        Redis::set("pelayanan:$id", $pelayanan);
        return $this->returnController("ok", $pelayanan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pelayanan = pelayanan::find($id);
        if (!$pelayanan) {
            return $this->returnController("error", "failed find data pelayanan");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $pelayanan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pelayanan");
        }
        Redis::del("pelayanan:all");
        Redis::del("pelayanan:$id");
        return $this->returnController("ok", "success delete data pelayanan");
    }
}
