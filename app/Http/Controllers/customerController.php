<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class customerController extends Controller
{   

    public function index(){

        return view('customer.index');
    }

    public function pengujianIndex(){

        return view('customer.pengujian.index');
    }
}
