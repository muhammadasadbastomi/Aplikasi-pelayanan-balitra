<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelayanan;

class PelayananController extends APIController
{
    public function get(){
        $pelayanan = Pelayanan::all();
        if (!$pelayanan) {
            return $this->returnController("error", "failed get pelayanan data");
        }
        return $this->returnController("ok", $pelayanan);
    }
}
