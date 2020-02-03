<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Pelayanan;
use App\Berita;
use App\Permohonan;
use App\Pengujian;
use App\Detail_permohonan;
use App\Karyawan;
use App\JenisPelayanan;
use App\user;
use App\Buah;
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

    public function buahIndex(){

        return view('admin.buah.index');
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
        $user = User::with('customer')->where('role',1)->get();
        return view('admin.pemohon.index',compact('user'));
    }

    public function jenisPelayananIndex(){
       
        return view('admin.jenisPelayanan.index');
    }

    public function analisisIndex(){
       
        return view('admin.analisis.index');
    }


    public function pelayananFilter(){
        $jenisPelayanan = jenisPelayanan::all();
        return view('admin.analisis.filter',compact('jenisPelayanan'));
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

    public function permohonanFilter(){

        return view('admin.permohonan.filter');
    }

    public function permohonanFilterWaktu(){

        return view('admin.permohonan.filterWaktu');
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
    public function pengujianEdit($uuid){
        $id = HCrypt::decrypt($uuid);
        $pengujian = pengujian::findOrFail($id);
        return view('admin.pengujian.edit',compact('pengujian'));
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

    public function pengujianCetak(){
        $pengujian = pengujian::with('permohonan')->get();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.pengujianKeseluruhan', ['pengujian'=>$pengujian,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data pengujian.pdf');
    }

        //cetak laporan data jenis Berita
        public function beritaCetak(){
            $berita=Berita::all();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.beritaKeseluruhan', ['berita'=>$berita,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data Jenis berita.pdf');
        }

        //cetak laporan data jenis Karyawan
        public function karyawanCetak(){
            $karyawan=karyawan::all();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.karyawanKeseluruhan', ['karyawan'=>$karyawan,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data Jenis karyawan.pdf');
        }

        //cetak laporan data jenis pelayanan
            public function permohonanFilterCetak(Request $request){
                $permohonan=permohonan::where('status',$request->status)->get();
                $tgl= Carbon::now()->format('d-m-Y');
                $pdf =PDF::loadView('laporan.permohonanFilter', ['permohonan'=>$permohonan,'tgl'=>$tgl]);
                $pdf->setPaper('a4', 'potrait');
                return $pdf->stream('Laporan data Permohonan Berdasarkan Status .pdf');
            }
        //cetak laporan data jenis pelayanan
        public function permohonanFilterWaktuCetak(Request $request){
            $permohonan = permohonan::whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->get();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.permohonanFilterWaktu', ['permohonan'=>$permohonan,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data Permohonan Berdasarkan Status .pdf');
        }

            //cetak laporan data jenis pelayanan
        public function pemohonCetak(){
            $pemohon=User::where('role',1)->get();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.pemohonKeseluruhan', ['pemohon'=>$pemohon,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data Pemohon.pdf');
        }

        //cetak laporan data jenis pelayanan
        public function buahCetak(){
            $buah=Buah::all();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.buahKeseluruhan', ['buah'=>$buah,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data Buah.pdf');
        }

            //cetak laporan data jenis pelayanan
            public function kategoriCetak(){
                $jenis_pelayanan=JenisPelayanan::all();
                $tgl= Carbon::now()->format('d-m-Y');
                $pdf =PDF::loadView('laporan.jenisPelayanan', ['jenis_pelayanan'=>$jenis_pelayanan,'tgl'=>$tgl]);
                $pdf->setPaper('a4', 'potrait');
                return $pdf->stream('Laporan data Buah.pdf');
            }
        // cetak pelayanan filter kategori
        public function pelayananFilterCetak(Request $request){
            $pelayanan = Pelayanan::where('jenis_pelayanan_id', $request->kategori)->get();
            $kategori = Jenispelayanan::findOrfail($request->kategori);
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.pelayananFilter', ['kategori'=>$kategori,'pelayanan'=>$pelayanan,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data Permohonan Berdasarkan Status .pdf');
        }

             //cetak laporan data jenis pelayanan
             public function notaCetak($id){
                $permohonan=permohonan::findOrfail($id);
                $tgl= Carbon::now()->format('d-m-Y');
                $pdf =PDF::loadView('laporan.notaCetak', ['permohonan'=>$permohonan,'tgl'=>$tgl]);
                $pdf->setPaper('a4', 'potrait');
                return $pdf->stream('Laporan data Buah.pdf');
            }

        // cetak pelayanan filter kategori
        public function pengujianCustomerCetak(){ 
            $customer_id = auth::id();
            $permohonan = permohonan::with('jenispelayanan','user','pengujian')->where('status',1)->where('user_id',$customer_id)->get();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.pengujianCustomer', ['permohonan'=>$permohonan,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data pengujian berdasarkan customer .pdf');
        }
        // cetak pelayanan filter kategori
        public function permohonanCustomerCetak(){ 
            $customer_id = auth::id();
            $permohonan = permohonan::with('jenispelayanan','user','pengujian')->whereIn('status',[0,2])->where('user_id',$customer_id)->get();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.permohonanCustomer', ['permohonan'=>$permohonan,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data permohonan berdasarkan customer .pdf');
        }
        //cetak laporan data jenis pelayanan
        public function detailPengujianCetak($id){
            $permohonan=permohonan::findOrfail($id);
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.detailPengujian', ['permohonan'=>$permohonan,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan Detail pengujian.pdf');
        }

        //cetak laporan data jenis pelayanan
        public function analisisPemohon(){
            $pemohon=User::where('role',1)->get();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.analisisPemohon', ['pemohon'=>$pemohon,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan data Pemohon.pdf');
        }

        //cetak laporan data jenis pelayanan
        public function analisisPermohonan(){
            $pelayanan=JenisPelayanan::all();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.analisisPermohonan', ['pelayanan'=>$pelayanan,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan analisis permohonan.pdf');
        }

        //cetak laporan data jenis pelayanan
        public function analisisPengujian(){
            $pelayanan=JenisPelayanan::all();
            $tgl= Carbon::now()->format('d-m-Y');
            $pdf =PDF::loadView('laporan.analisisPengujian', ['pelayanan'=>$pelayanan,'tgl'=>$tgl]);
            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream('Laporan analisis permohonan.pdf');
        }
}
 