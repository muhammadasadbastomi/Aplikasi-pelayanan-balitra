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

    public function jenisPelayananIndex(){
       
        return view('admin.jenisPelayanan.index');
    }

    public function karyawanIndex(){
       
        return view('admin.karyawan.index');
    }

    public function karyawanEdit(){
       
        return view('admin.karyawan.edit');
    }

    public function karyawanInfo(){
       
        return view('admin.karyawan.info');
    }
}
