<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class SettingController extends Controller
{
    public function emailvarification(){
        return view('users.emailvarification');
    }

    protected function register(Request $request)
    {
        $this->validate(request(), [
            'firstname' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $length=10;
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
       
        $activation_link = $code;
        
        $name=$request->firstname . $request->lastname;
        $user=User::create([
           'name' => $name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'varification_code' => $code,
       ]);
       auth()->login($user);
       try{
           $email = $request->email;
        $email_data = array('activation_link' => $activation_link, 'name' => $name);
        $test = Mail::send(['html'=>'users.reglinkmail'], $email_data, function($message) use($email) {
        $message->to($email)->subject('Notification: Password Reset');
        $message->from('test@gmail.com','Activation link');
        });
        
        }
        catch(Exception $e) {
            
          }
        
          return redirect('/home');
    }
    public function verification($id){
       
       
        $check = DB::table('users')->where('varification_code',$id)->pluck('varification_code')->first();
       
        if($check == null){
             return redirect('login')->with('message', 'Verification link is expired');
        }
       
        if($check == $id)
        {
            
            DB::table('users')->where('varification_code', $id)->update([
                'email_verified_at' => 1,
                'varification_code' => null,
                
                ]);
                return redirect('/home')->with('mailverified','Verification link verified');
        }
        else{
          return redirect('login')->with('message','Verification link not verified');
        }
         
    }
    public function resetPassword(Request $request) {

        if(isset($request['email'])) {

        $user = DB::table('users')->where('email',$request['email'])->first();
        if($user == null){
        return redirect()->back()->with('alert', __('Invalid Email'));
        }
        else {

        $new_pas = rand(100000,999999);
        DB::table('users')->where('email',$request['email'])->update([
        "password" => bcrypt($new_pas)
        ]);

        $name = DB::table('users')->where('email',$request['email'])->pluck('name')->first();
        $email = $request['email'];
        try{
        $email_data = array('new_pas' => $new_pas , 'name' => $name);
        $test = Mail::send(['html'=>'auth.email.password-reset-view'], $email_data, function($message) use($email) {
        $message->to($email)->subject('Notification: Password Reset');
        $message->from('usmanathar33m@gmail.com','Password Reset');
        });
    }
    catch(Exception $e) {
            
    }
        return redirect('login')->with('success', __('New Password Successfully Sent,Check Mail'));
        }
        }
        return redirect()->back()->with('alert', __('Something Wrong'));
    }

}
