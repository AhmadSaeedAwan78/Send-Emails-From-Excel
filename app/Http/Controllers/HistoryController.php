<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    //

    public function index(){
       $history =  DB::table('progress')->where('user_id' , auth()->user()->id)->orderBy('id' , 'desc')->paginate(5);
       $check =  DB::table('progress')->where('user_id' , auth()->user()->id)->orderBy('id' , 'desc')->get();
       $total_sent = 0;
       $opened = 0;
       foreach ($check as $data){
        $total_sent = $total_sent + $data->total_emails;
        $opened = $opened + $data->openings;
        }
       return view('users.history' , compact('history' , 'total_sent' , 'opened'));
    }
    public function update_openings($job_id = 0){
        if($job_id == 0){
            return redirect('/')->with('message' , 'Job Not Found');
        }
        $email_job = DB::table('progress')->where('job_id' , $job_id)->first();
        if($email_job != null){
            $openings_count = $email_job->openings;
            $openings_count ++;
            DB::table('progress')->where('job_id' , $job_id)->update([
                'openings'=>$openings_count,
            ]);
            return redirect('/')->with('message' , 'Welcome, Please Signup to enjoy our services');

        }
        else{
            return redirect('/')->with('message' , 'Job Not Found');

        }
    }
}
