<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permohonan;
use HCrypt;

class PermohonanController extends APIController
{
    public function get(){
        $permohonan = json_decode(redis::get("permohonan::all"));
        if (!$permohonan) {
            $permohonan = permohonan::with('jenispelayanan')->get();
            if (!$permohonan) {
                return $this->returnController("error", "failed get permohonan data");
            }
            Redis::set("permohonan:all", $permohonan);
        }
        return $this->returnController("ok", $permohonan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $permohonan = Redis::get("permohonan:$id");
        if (!$permohonan) {
            $permohonan = permohonan::with('jenispelayanan')->where('id', $id)->first();
            if (!$permohonan){
                return $this->returnController("error", "failed find data permohonan");
            }
            Redis::set("permohonan:$id", $permohonan);
        }
        return $this->returnController("ok", $permohonan);
    }

    public function create(Request $req){
        $user_id = auth::id();
        $permohonan = new permohonan;
        // decrypt foreign key id
        $permohonan->user_id = $user_id;
        $permohonan->jenispermohonan_id = Hcrypt::decrypt($req->jenispelayanan_id);
        $permohonan->keterangan = $req->keterangan;

        $permohonan->save();

        //set uuid
        $permohonan_id = $permohonan->id;
        $uuid = HCrypt::encrypt($permohonan_id);
        $setuuid = permohonan::findOrFail($permohonan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$permohonan) {
            return $this->returnController("error", "failed create data permohonan");
        }
        Redis::del("permohonan:all");
        Redis::set("permohonan:all", $permohonan);
        return $this->returnController("ok", $permohonan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $permohonan = permohonan::findOrFail($id);
        $permohonan->jenispelayanan_id = Hcrypt::decrypt($req->jenispelayanan_id);
        $permohonan->name = $req->name;
        $permohonan->price = $req->price;
        $permohonan->update();
        if (!$permohonan) {
            return $this->returnController("error", "failed find data pelayanan");
        }
        $permohonan = pelayanan::with('jenispelayanan')->where('id',$id)->first();
        Redis::del("pelayanan:all");
        Redis::set("pelayanan:$id", $permohonan);
        return $this->returnController("ok", $permohonan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $permohonan = permohonan::find($id);
        if (!$permohonan) {
            return $this->returnController("error", "failed find data permohonan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $permohonan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data permohonan");
        }

        Redis::del("permohonan:all");
        Redis::del("permohonan:$id");

        return $this->returnController("ok", "success delete data permohonan");
    }
}