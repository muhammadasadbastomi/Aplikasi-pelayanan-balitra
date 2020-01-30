<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Inbox;
use App\Customer;
use App\User;
use App\Permohonan;
use HCrypt;
use Illuminate\Http\Request;

class customerController extends Controller
{   

    public function index(){

        return view('customer.index');
    }

    public function profil_tambah(){
        $user = User::findOrFail(Auth::user()->id);
        // dd($user);
        $customer = $user->customer;
        // // dd($customer);
        // $customer = count($customer);
        if(isset($customer)){
            $customers = 1;
          }else{
            $customers = 0;
          }
        //dd($customer);
        if($customers == 0){
            return view('customer.profil.tambah');
        }
            $customer_data = customer::where('user_id',Auth::user()->id)->first();
            return view('customer.profil.edit',compact('customer_data'));
    }

    public function profil_tambah_store(Request $request){
        $user_id = Auth::user()->id;

        $customer = new customer;

        $customer->nama       = $request->nama;
        $customer->alamat       = $request->alamat;
        $customer->telepon      = $request->telepon;
        $customer->user_id      = $user_id;


        $customer->save();

          return redirect(route('customerIndex'))->with('success', 'Data customer '.$customer->user->name.' Berhasil di Tambahkan');
      }//fungsi menambahkan data customer

    public function profilEdit(){

        return view('customer.profil.tambah');
    }

    public function profil_update(Request $request){
        $user_id = Auth::user()->id;
        $customer = Customer::where('user_id', $user_id)->first();

        $customer->nama       = $request->nama;
        $customer->alamat       = $request->alamat;
        $customer->telepon      = $request->telepon;

        $customer->update();
        return redirect(route('customerIndex'))->with('success', 'Data Customer '.$request->nama.' berhasil di ubah');
    }

    public function permohonanIndex(){
        $user_id = auth::id();
        return view('customer.permohonan.index',compact('user_id'));
    }

    public function pengujianCustomerindex(){
        $user_id = auth::id();
        return view('customer.pengujian.index',compact('user_id'));
    }

    public function pengujianCustomerDetail($uuid){
        $id = HCrypt::decrypt($uuid);
        $permohonan = permohonan::findOrFail($id);
        return view('customer.pengujian.detail',compact('permohonan'));
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
