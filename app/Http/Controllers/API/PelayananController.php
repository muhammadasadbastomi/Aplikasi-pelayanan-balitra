<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelayanan;
use Redis;

class PelayananController extends APIController
{
    public function get(){
        $pelayanan = Redis::get("pelayanan:all");
        if (!$pelayanan) {
            $pelayanan = Pelayanan::all();
            Redis::set("pelayanan:all", $pelayanan);
        }
        if (!$pelayanan) {
            return $this->returnController("error", "failed get pelayanan data");
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
