<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Inbox;
use App\Permohonan;
use HCrypt;
use Illuminate\Http\Request;

class customerController extends Controller
{   

    public function index(){

        return view('customer.index');
    }
    public function profilEdit(){

        return view('customer.profil.tambah');
    }
    
    public function permohonanIndex(){
        $user_id = auth::id();
        return view('customer.permohonan.index',compact('user_id'));
    }

    public function permohonanAdd($uuid){
        $id = HCrypt::decrypt($uuid);
        $permohonan = permohonan::findOrFail($id);
        return view('customer.permohonan.add',compact('permohonan'));
    }

    public function pengujianIndex(){

        return view('customer.pengujian.index');
    }

    public function notifIndex(){
        $user_id = auth::id();
        $inbox = inbox::where('user_id', $user_id)->get();
        return view('customer.notif.index',compact('inbox'));
    }  

    public function notifdetail($id){
        $inbox = inbox::findOrFail($id);
        $inbox->status = 1;
        $inbox->update();
        return view('customer.notif.detail',compact('inbox'));
    }
}
