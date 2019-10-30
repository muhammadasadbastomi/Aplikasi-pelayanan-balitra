<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Karyawan;
use HCrypt;
use Redis;

class KaryawanController extends APIController
{
    public function get(){
        $karyawan = Redis::get("karyawan:all");
        if (!$karyawan) {
            $karyawan = karyawan::all();
            if (!$karyawan) {
                return $this->returnController("error", "failed get karyawan data");
            }
            Redis::set("karyawan:all", $karyawan);
        }
        return $this->returnController("ok", $karyawan);
    }
}
