<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganController extends Controller
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
}
