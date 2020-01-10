<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Inbox;
use Illuminate\Http\Request;

class customerController extends Controller
{   

    public function index(){

        return view('customer.index');
    }
    public function profilEdit(){

        return view('customer.profil.tambah');
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
