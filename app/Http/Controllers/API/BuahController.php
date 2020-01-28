<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Buah;
use HCrypt;

class BuahController extends APIController
{
    public function get(){
        $buah = json_decode(redis::get("buah::all"));
        if (!$buah) {
            $buah = buah::with('jenis_buah')->get();
            if (!$buah) {
                return $this->returnController("error", "failed get buah data");
            }
            Redis::set("buah:all", $buah);
        }
        return $this->returnController("ok", $buah);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $buah = Redis::get("buaha:all");
        if (!$buah) {
            $buah = buah::where('jenis_buah_id',$id)->get();
            if (!$buah){
                return $this->returnController("error", "failed find data buah");
            }
            Redis::set("buah:all", $buah);
        }
        return $this->returnController("ok", $buah);
    }

    public function findEdit($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $buah = Redis::get("buah:$id");
        if (!$buah) {
            $buah = buah::with('jenis_buah')->where('id',$id)->first();
            if (!$buah){
                return $this->returnController("error", "failed find data buah");
            }
            Redis::set("buah:$id", $buah);
        }
        return $this->returnController("ok", $buah);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());
        $buah = new buah;
        // decrypt foreign key id
        $buah->name = $req->name;
        $buah->satuan = $req->satuan;
        $buah->price = $req->price;

        $buah->save();

        //set uuid
        $buah_id = $buah->id;
        $uuid = HCrypt::encrypt($buah_id);
        $setuuid = buah::findOrFail($buah_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$buah) {
            return $this->returnController("error", "failed create data buah");
        }
        Redis::del("buah:all");
        Redis::set("buah:all", $buah);
        return $this->returnController("ok", $buah);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $buah = buah::findOrFail($id);
        $buah->name = $req->name;
        $buah->satuan = $req->satuan;
        $buah->price = $req->price;
        $buah->update();
        if (!$buah) {
            return $this->returnController("error", "failed find data buah");
        }
        $buah = buah::with('jenis_buah')->where('id',$id)->first();
        Redis::del("buah:all");
        Redis::set("buah:$id", $buah);
        return $this->returnController("ok", $buah);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $buah = buah::find($id);
        if (!$buah) {
            return $this->returnController("error", "failed find data buah");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $buah->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data buah");
        }
        Redis::del("buah:all");
        Redis::del("buah:$id");
        return $this->returnController("ok", "success delete data buah");
    }
}
