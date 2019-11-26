<?php

namespace App\Http\Controllers;
use App\Pelayanan;
use Carbon\Carbon;
use PDF;

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

    public function jenisPelayananEdit(){
       
        return view('admin.jenisPelayanan.edit');
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

      //cetak laporan data jenis pelayanan
  public function pelayananCetak(){
    $pelayanan=pelayanan::all();
    $tgl= Carbon::now()->format('d-m-Y');
    $pdf =PDF::loadView('laporan.pelayananKeseluruhan', ['pelayanan'=>$pelayanan,'tgl'=>$tgl]);
    $pdf->setPaper('a4', 'potrait');
    return $pdf->stream('Laporan data Jenis Pelayanan.pdf');
  }
}
