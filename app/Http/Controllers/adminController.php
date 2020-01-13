<?php

namespace App\Http\Controllers;
use App\Pelayanan;
use App\Berita;
use App\Permohonan;
use App\Detail_permohonan;
use Carbon\Carbon;
use PDF;
use HCrypt;


use Illuminate\Http\Request;

class adminController extends Controller
{   
    //fungsi beranda admin
    public function index(){

        return view('admin.index');
    }

    //fungsi beranda admin
    public function depan(){
        $berita = Berita::paginate(3);
        return view('welcome',compact('berita'));
    }

    public function beritaDepan(){
        $berita = Berita::all();
        return view('berita',compact('berita'));
      }
      
    public function beritaDetail($uuid){
        $id = HCrypt::decrypt($uuid);
        $berita = Berita::findOrFail($id);
        return view('beritaDetail',compact('berita'));
    }

    //fungsi halaman data pemohon
    public function pemohonIndex(){
       
        return view('admin.pemohon.index');
    }

    public function jenisPelayananIndex(){
       
        return view('admin.jenisPelayanan.index');
    }

    public function analisisIndex(){
       
        return view('admin.analisis.index');
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

    public function beritaIndex(){
       
        return view('admin.berita.index');
    }

    public function permohonanIndex(){
       
        return view('admin.permohonan.index');
    }

    public function permohonanAdd(){

        return view('admin.permohonan.add',compact('permohonan'));
    }

    public function verifikasiPermohonan($uuid){
        $id = HCrypt::decrypt($uuid);
        $permohonan = permohonan::findOrFail($id);
        return view('admin.permohonan.verifikasi',compact('permohonan'));
    }

    public function pengujianIndex(){
       
        return view('admin.pengujian.index');
    }

    public function pengujianDetail($uuid){
        $id = HCrypt::decrypt($uuid);
        $permohonan = permohonan::findOrFail($id);
        return view('admin.pengujian.detail',compact('permohonan'));
    }

    //cetak laporan data jenis pelayanan
    public function pelayananCetak(){
        $pelayanan=pelayanan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.pelayananKeseluruhan', ['pelayanan'=>$pelayanan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Jenis Pelayanan.pdf');
    }

    //cetak laporan data jenis pelayanan
    public function permohonanCetak(){
        $permohonan=permohonan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.permohonanKeseluruhan', ['permohonan'=>$permohonan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Jenis permohonan.pdf');
    }

        //cetak laporan data jenis pelayanan
        public function beritaCetak(){
            $berita=Berita::all();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.beritaKeseluruhan', ['berita'=>$berita,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data Jenis berita.pdf');
        }
}
