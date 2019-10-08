<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{   
    //fungsi beranda admin
    public function index(){

        return view('admin.index');
    }

    //fungsi halaman data pemohon
    public function pemohonIndex(){
       
        return view('admin.pemohon.index');
    }

}
