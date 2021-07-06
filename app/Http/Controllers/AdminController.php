<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class AdminController extends Controller
{
    public function subbyadmin(Request $request){
        $check= DB::table('purchased_plans')->where('user_id',$request->user_id)->first();

        if($check==null){
            DB::table('purchased_plans')->insert([
                'plan_id' => 1,
                'user_id' => $request->user_id,
                'stripe_charge_id' => null,
                    'amount' => null,
                    'plan_type' => 'Subscribed by Admin',
                    'expirey_date' => $request->ex_date
            ]);
            DB::table('users')
            ->where('id', $request->user_id)
            ->update(['package_status' => 1]);
        }
        else{
            DB::table('purchased_plans')->where('user_id',$request->user_id)->update([
                'expirey_date' => $request->ex_date
            ]);
            DB::table('users')
            ->where('id', $request->user_id)
            ->update(['package_status' => 1]);
        }


        return redirect('users-list')->with('message', 'Payment is Successfull');
    }
    public function userslist(){
        $users=DB::table('users')->where('is_admin','!=', 1)->get();
       return view('admin.users',compact('users'));
    }
    public function add_users(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'unique:users|required|email',
            'password' => 'required',
            'mobile' => 'required',
        ]);
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => 1,
            'image'=>null,
            'mobile'=>$request->mobile,
        ]);
        if($user){
            return redirect('users-list');
        }
    }
    public function deleteuser($id){
       $delete=DB::table('users')->where('id',$id)->delete();
        if($delete){
            return redirect('users-list');
        }
    }
        public function Cancelplan($id){
            $cancel=DB::table('users')->where('id',$id)->update([
'stripe_connect_id'=>null,
'package_status'=>0,

            ]);
            $delete=DB::table('purchased_plans')->where('user_id',$id)->delete();
             if($cancel){
                 return redirect('users-list');
             }
    }
}
