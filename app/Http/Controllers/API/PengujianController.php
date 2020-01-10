<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permohonan;
use App\Pengujian;
use App\Inbox;
use HCrypt;

class PengujianController extends APIController
{
    public function get(){
        $pengujian = json_decode(redis::get("pengujian::all"));
        if (!$pengujian) {
            $pengujian = pengujian::with('permohonan','user')->where('status',1)->get()->load('jenis_pelayanan');
            if (!$pengujian) {
                return $this->returnController("error", "failed get pengujian data");
            }
            Redis::set("pengujian:all", $pengujian);
        }
        return $this->returnController("ok", $pengujian);
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
            $pengujian->status = $status->status;
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
        $pengujian->jenispengujian_id = Hcrypt::decrypt($req->jenispengujian_id);
        $pengujian->name = $req->name;
        $pengujian->price = $req->price;
        $pengujian->update();
        if (!$pengujian) {
            return $this->returnController("error", "failed find data pengujian");
        }
        $pengujian = pengujian::with('jenispengujian')->where('id',$id)->first();
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
