<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Inbox;
use App\Permohonan;
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

        return view('customer.permohonan.index');
    }

    public function permohonanAdd(){
        $user_id = auth::id();
        $permohonan = new permohonan;
        // decrypt foreign key id
        $permohonan->user_id = $user_id;

        $permohonan->save();

        $permohonan_id = $permohonan->id;
        $uuid = HCrypt::encrypt($permohonan_id);
        $setuuid = permohonan::findOrFail($permohonan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();

        return view('customer.permohonan.add',compact('permohonan_id'));
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
