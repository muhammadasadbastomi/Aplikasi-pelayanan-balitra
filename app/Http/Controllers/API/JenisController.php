<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JenisPelayanan;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class JenisController extends APIController
{
    public function get(){
        $jenispelayanan = json_decode(redis::get("jenispelayanan::all"));
        if (!$jenispelayanan) {
            $jenispelayanan = jenispelayanan::all();
            if (!$jenispelayanan) {
                return $this->returnController("error", "failed get jenispelayanan data");
            }
            Redis::set("jenispelayanan:all", $jenispelayanan);
        }
        return $this->returnController("ok", $jenispelayanan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $jenispelayanan = Redis::get("jenispelayanan:$id");
        if (!$jenispelayanan) {
            $jenispelayanan = jenispelayanan::find($id);
            if (!$jenispelayanan){
                return $this->returnController("error", "failed find data jenispelayanan");
            }
            Redis::set("jenispelayanan:$id", $jenispelayanan);
        }
        return $this->returnController("ok", $jenispelayanan);
    }

    public function create(Request $req){
        $jenispelayanan = jenispelayanan::create($req->all());
        
        //set uuid
        $jenispelayanan_id = $jenispelayanan->id;
        $uuid = HCrypt::encrypt($jenispelayanan_id);
        $setuuid = jenispelayanan::findOrFail($jenispelayanan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$jenispelayanan) {
            return $this->returnController("error", "failed create data jenispelayanan");
        }
        Redis::del("jenispelayanan:all");
        Redis::set("jenispelayanan:all", $jenispelayanan);
        return $this->returnController("ok", $jenispelayanan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
       
        $jenispelayanan = jenispelayanan::findOrFail($id);

        if (!$jenispelayanan) {
            return $this->returnController("error", "failed find data jenispelayanan");
        }

        $jenispelayanan->fill($req->all())->save();

        Redis::del("jenispelayanan:all");
        Redis::set("jenispelayanan:$id", $jenispelayanan);
        return $this->returnController("ok", $jenispelayanan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $jenispelayanan = jenispelayanan::find($id);
        if (!$jenispelayanan) {
            return $this->returnController("error", "failed find data jenispelayanan");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $jenispelayanan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data jenispelayanan");
        }
        Redis::del("jenispelayanan:all");
        Redis::del("jenispelayanan:$id");
        return $this->returnController("ok", "success delete data jenispelayanan");
    }
}
