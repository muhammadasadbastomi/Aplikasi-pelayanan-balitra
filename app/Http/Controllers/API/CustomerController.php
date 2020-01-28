<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use HCrypt;

class CustomerController extends APIController
{
    public function get(){
        $customer = json_decode(redis::get("customer::all"));
        if (!$customer) {
            $customer = customer::with('user')->get();
            if (!$customer) {
                return $this->returnController("error", "failed get customer data");
            }
            Redis::set("customer:all", $customer);
        }
        return $this->returnController("ok", $customer);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $customer = Redis::get("customer:$id");
        if (!$customer) {
            $customer = customer::with('user')->where('id', $id)->first();
            if (!$customer){
                return $this->returnController("error", "failed find data customer");
            }
            Redis::set("customer:$id", $customer);
        }
        return $this->returnController("ok", $customer);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $customer = customer::find($id);
        $user = user::find($customer->user_id);
        if (!$user) {
            return $this->returnController("error", "failed find data customer");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $image_path = "img/user/".$user->foto;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
        File::delete($image_path);
        }
        $delete = $user->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data customer");
        }

        Redis::del("user:all");
        Redis::del("user:$customer->user_id");

        return $this->returnController("ok", "success delete data customer");
    }
}