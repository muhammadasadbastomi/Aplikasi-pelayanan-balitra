<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelayanan;
use HCrypt;
use Redis;

class PelayananController extends APIController
{
    public function get(){
        $pelayanan = Redis::get("pelayanan:all");
        if (!$pelayanan) {
            $pelayanan = Pelayanan::all();
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
            $pelayanan = Pelayanan::find($id);
            if (!$pelayanan){
                return $this->returnController("error", "failed find data pelayanan");
            }
            Redis::set("pelayanan:$id", $pelayanan);
        }

        return $this->returnController("ok", $pelayanan);
    }

    public function create(Request $req){
        $create = Pelayanan::create($req->all());
        if (!$create) {
            return $this->returnController("error", "failed create data pelayanan");
        }
        Redis::del("pelayanan:all");
        return $this->returnController("ok", $create);
    }
}
