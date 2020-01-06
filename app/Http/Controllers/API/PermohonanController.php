<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Detail_permohonan;
use App\Permohonan;
use HCrypt;

class PermohonanController extends APIController
{
    public function get(){
        $permohonan = json_decode(redis::get("permohonan::all"));
        if (!$permohonan) {
            $permohonan = permohonan::with('jenispelayanan','user')->get();
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
        $permohonan->jenispelayanan_id = Hcrypt::decrypt($req->jenispelayanan_id);
        $permohonan->keterangan = $req->keterangan;

        $permohonan->save();

        $pelayanans = $req->input('pelayanan_id');
        foreach ($pelayanans as $pelayanan)
        {
            $permohonan_detail = new Detail_permohonan;
            $permohonan_detail->permohonan_id = $permohonan->id;
            $permohonan_detail->pelayanan_id = HCrypt::decrypt($pelayanan);
            $permohonan_detail->save();
        }

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

    //permohonan detail

    public function permohonan_create(Request $req){
        $permohonan_id = HCrypt::decrypt($req->id);
        $pelayanans = $req->input('pelayanan');
        foreach ($pelayanans as $pelayanan)
        {
            $permohonan_detail = new Permohonan_detail;
            $permohonan_detail->permohonan_id = $permohonan_id;
            $permohonan_detail->pelayanan_id = $pelayanan;
            $permohonan_detail->save();
        }
        
        $permohonan_detail_id= $permohonan_detail->id;
        
        $uuid = HCrypt::encrypt($permohonan_detail_id);
        $setuuid = permohonan_detail::findOrFail($permohonan_detail_id);
        $setuuid->uuid = $uuid;
            
        $setuuid->update();

        if (!$permohonan_detail) {
            return $this->returnController("error", "failed create data permohonan detail");
        }

        Redis::del("permohonan_detail:all");
        Redis::set("permohonan_detail:all",$permohonan_detail);
        return $this->returnController("ok", $permohonan_detail);
    }

    public function permohonan_get($uuid){
        $permohonan_id = HCrypt::decrypt($uuid);
        $permohonan_detail = json_decode(redis::get("permohonan_detail::all"));
        if (!$permohonan_detail) {
            $permohonan_detail = permohonan_detail::with('permohonan')->where('permohonan_id', $permohonan_id)->get();
            if (!$permohonan_detail) {
                return $this->returnController("error", "failed get permohonan detail data");
            }
            Redis::set("permohonan_detail:all", $permohonan_detail);
        }
        return $this->returnController("ok", $permohonan_detail);
    }

    public function permohonan_delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $permohonan_detail = permohonan_detail::find($id);
        if (!$permohonan_detail) {
            return $this->returnController("error", "failed find data permohonan detail");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $permohonan_detail->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data permohonan detail");
        }

        Redis::del("permohonan_detail:all");
        Redis::del("permohonan_detail:$id");

        return $this->returnController("ok", "success delete data permohonan detail");
    }
}