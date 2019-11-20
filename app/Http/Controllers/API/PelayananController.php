<?php
namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelayanan;
use HCrypt;

class PelayananController extends APIController
{
    public function get(){
        $pelayanan = json_decode(redis::get("pelayanan::all"));
        // $pelayanan = Redis::get("pelayanan:all");
        if (!$pelayanan) {
            $pelayanan = Pelayanan::all();
            if (!$pelayanan) {
                return $this->returnController("error", "failed get pelayanan data");
            }
            Redis::set("pelayanan:all", $pelayanan);
        }
        return $this->returnController("ok", $pelayanan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pelayanan = Redis::get("pelayanan:$id");
        if (!$pelayanan) {
            $pelayanan = Pelayanan::find($id);
            if (!$pelayanan){
                return $this->returnController("error", "failed find data pelayanan");
            }
            Redis::set("pelayanan:$id", $pelayanan);
        }

        return $this->returnController("ok", $pelayanan);
    }

    public function create(Request $req){
        $create = Pelayanan::create($req->all());
        if (!$create) {
            return $this->returnController("error", "failed create data pelayanan");
        }
        $uuid = HCrypt::encrypt($create->id);
        $merge = (['uuid' => $uuid, 'create' => $create]);
        Redis::del("pelayanan:all");
        return $this->returnController("ok", $merge);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pelayanan = Pelayanan::find($id);
        if (!$pelayanan) {
            return $this->returnController("error", "failed find data pelayanan");
        }

        $update = $pelayanan->update($req->all());
        if (!$update) {
            return $this->returnController("error", "failed find data pelayanan");
        }

        Redis::del("pelayanan:all");
        Redis::set("pelayanan:$id", $update);

        return $this->returnController("ok", $update);
    }

    public function delete($id){
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pelayanan = Pelayanan::find($id);
        if (!$pelayanan) {
            return $this->returnController("error", "failed find data pelayanan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)

        $delete = $pelayanan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pelayanan");
        }

        Redis::del("pelayanan:all");
        Redis::del("pelayanan:$id");

        return $this->returnController("ok", "success delete data pelayanan");
    }
}
