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
}
