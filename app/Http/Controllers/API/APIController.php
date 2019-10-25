<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIController extends Controller
{
    protected function returnController($status, $data){
        return collect(["status" => $status, "data" => $data])->toJson();
    }
}
