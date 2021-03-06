<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Detail_permohonan;
use App\Jenis_pelayanan;
use App\Permohonan;
use App\Pengujian;
use App\Inbox;
use HCrypt;
use Carbon;
use Auth;

class PengujianController extends APIController
{
    public function get(){
        $permohonan = json_decode(redis::get("permohonan::all"));
        if (!$permohonan) {
            $permohonan = permohonan::with('jenispelayanan','user','pengujian')->where('status',1)->get();
            // $permohonan = permohonan::with('user')->where('status',1)->get()->load('jenis_pelayanan');
            if (!$permohonan) {
                return $this->returnController("error", "failed get permohonan data");
            }
            Redis::set("permohonan:all", $permohonan);
        }
        return $this->returnController("ok", $permohonan);
    }

    public function getByCustomer(){
        $user_id = auth::id();
        $permohonan = json_decode(redis::get("permohonan::all"));
        if (!$permohonan) {
            $permohonan = permohonan::with('jenispelayanan','user','pengujian')->where('status',1)->where('user_id',$user_id)->get();
            // $permohonan = permohonan::with('user')->where('status',1)->get()->load('jenis_pelayanan');
            if (!$permohonan) {
                return $this->returnController("error", "failed get permohonan data");
            }
            Redis::set("permohonan:all", $permohonan);
        }
        return $this->returnController("ok", $permohonan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pengujian = Redis::get("pengujian:$id");
        if (!$pengujian) {
            $pengujian = pengujian::where('permohonan_id',$id)->get();
            if (!$pengujian){
                return $this->returnController("error", "failed find data pengujian");
            }
            Redis::set("pengujian:$id", $pengujian);
        }
        return $this->returnController("ok", $pengujian);
    }
    
    public function create(Request $req){
        $id = $req->permohonan_id;
        //update status
        $status = Permohonan::findOrFail($id);
        $status->status = $req->status;
        $status->update();
        // dd($req);
        $user_id = $status->user_id;
        // dd($user_id);

        $inbox = new inbox;

        $inbox->user_id         = $user_id;
        $inbox->permohonan_id   = $id;
        $subjek = 'Verifikasi permohonan pengujian';
        $inbox->subjek          = $subjek;
        $inbox->keterangan      = $req->keterangan;
        $inbox->tgl_antar      = $req->tgl_antar;
        $inbox->save();

        //set uuid
        $inbox_id = $inbox->id;
        $uid = HCrypt::encrypt($inbox_id);
        $setuid = inbox::findOrFail($inbox_id);
        $setuid->uuid = $uid;
        $setuid->update();

        if($req->status==1)
        {
            $pengujian = new pengujian;
            $pengujian->user_id = $user_id;
            $pengujian->permohonan_id           = $id;
            $pengujian->tanggal = $req->tgl_antar;
            $pengujian->status = $req->status;
            $pengujian->biaya = $status->biaya;
            $pengujian->save();

            //set uuid
            $pengujian_id = $pengujian->id;
            $uuid = HCrypt::encrypt($pengujian_id);
            $setuuid = pengujian::findOrFail($pengujian_id);
            $setuuid->uuid = $uuid;
            $setuuid->update();
            if (!$pengujian) {
                return $this->returnController("error", "failed create data pengujian");
            }
            Redis::del("pengujian:all");
            Redis::set("pengujian:all", $pengujian);
            return view('admin.permohonan.index');
        }

        return redirect()->route('permohonanIndex');

    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pengujian = pengujian::findOrFail($id);
        
        $pengujian->tanggal_terima = $req->tanggal_terima;
        $pengujian->metode_pembayaran = $req->metode_pembayaran;
        $pengujian->estimasi = $req->estimasi;
        $pengujian->status = $req->status;
        $pengujian->lainnya = $req->lainnya;
        $pengujian->keterangan = $req->keterangan;
        $pengujian->update();
        if (!$pengujian) {
            return $this->returnController("error", "failed find data pengujian");
        }
        $pengujian = permohonan::with('jenispelayanan','user','pengujian')->where('status',1)->get();
        Redis::del("pengujian:all");
        Redis::set("pengujian:$id", $pengujian);
        return $this->returnController("ok", $pengujian);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pengujian = pengujian::find($id);
        if (!$pengujian) {
            return $this->returnController("error", "failed find data pengujian");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $pengujian->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pengujian");
        }
        Redis::del("pengujian:all");
        Redis::del("pengujian:$id");
        return $this->returnController("ok", "success delete data pengujian");
    }
}
