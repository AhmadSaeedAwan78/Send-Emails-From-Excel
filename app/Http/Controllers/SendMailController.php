<?php

namespace App\Http\Controllers;


use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\excelEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SendMailController extends Controller
{
    //

        public function send_emails(){

            return view('users.send_emails');



    }
    public function send_emails_job(Request $request){
//            dd($request);
        $this->validate($request,[
            'file' => 'required|mimes:xlsx',
            'receiver_file' => 'required|mimes:xlsx',
            'subject' => 'required|min:5',
            'email_message' => 'required|min:5',

        ],$messages = [
            'mimes' => 'Only Excel (.xlsx) type files are allowed',
            'file.required'=>'Please Select Sender File to proceed',
            'receiver_file.required'=>'Please Select Receiver File to proceed',
            'subject.required'=>'Email Subject is required to proceed',
            'email_message.required'=>'Please Enter Message to proceed',
            'subject.min'=>'Please enter Subject with at least 5 characters',
            'email_message.min'=>'Please enter Message with at least 5 characters',

        ]);
        $ses_err_message = "";
        $imported_user_count = 0;
        $missing_entry_check = 'true';
        $sec_check = 'false';
        $sender_file_name = '';
        $receiver_file_name = '';

        //sender_file
        $path = request()->file('file')->getRealPath();
        $path1 = request()->file('file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        $emails =  Excel::toArray(new excelEmail, $path);
//        dd($path);
        $file=$request->file('file');
        $filename = $file->getClientOriginalName();
        $ext=$file->getClientOriginalExtension();
        $file_name='sender_file_uploaded_at_'.date("Y_m_d H_i_s").'_by_'.auth()->user()->name.'_.'.$ext;
        $sender_file_name = $file_name;
        $destinationpath=public_path('files/');
        $file->move($destinationpath,$file_name);

        //recevier File
        $path = request()->file('receiver_file')->getRealPath();
        $path1 = request()->file('receiver_file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        $reciever =  Excel::toArray(new excelEmail, $path);

        $file=$request->file('receiver_file');
        $filename = $file->getClientOriginalName();
        $ext=$file->getClientOriginalExtension();
        $file_name='reciever_file_uploaded_at_'.date("Y_m_d H_i_s").'_by_'.auth()->user()->name.'_.'.$ext;
        $receiver_file_name = $file_name;
        $destinationpath=public_path('files/');
        $file->move($destinationpath,$file_name);

        if(empty($emails)){
            $ses_err_message.= 'Sender Excel File is empty;';
            Session::flash('error_message',  $ses_err_message);
            return redirect("send-emails");
        }
        if($emails == null){
            $ses_err_message.= 'Sender Excel File is empty;';
            Session::flash('error_message',  $ses_err_message);
            return redirect("send-emails");
        }

        $sender_emails = $emails[0];

        //reciever
        if(empty($reciever)){
            $ses_err_message.= 'Recever Excel File is empty;';
            Session::flash('error_message',  $ses_err_message);
            return redirect("send-emails");
        }
        if($reciever == null){
            $ses_err_message.= 'Recever Excel File is empty;';
            Session::flash('error_message',  $ses_err_message);
            return redirect("send-emails");
        }

        $recever_emails = $reciever[0];

        $recever_emails_array = array();
        $sender_emails_array = array();

        foreach($recever_emails as $recever_email){
            if ($recever_email['emails'] == null) {
                continue;
            }
            $recever_emails_array[] =$recever_email['emails'];
        }

        foreach($sender_emails as $sender_email){
            if ($sender_email['emails'] == null) {
                continue;
            }
            $sender_emails_array[] =$sender_email['emails'];
        }
        $job_id =uniqid();
//        dd($sender_emails_array, $recever_emails_array);
        $total_sender_count = count($sender_emails_array)-1;

        DB::table('progress')->insert([
            'job_id' => $job_id,
            'subject'=>$request->subject,
            'message'=>$request->email_message,
            'total_emails'=>count($recever_emails_array),
            'user_id'=>auth()->user()->id,
            'sender_file_name'=>$sender_file_name,
            'receiver_file_name' =>$receiver_file_name,
            'remaining_emails' =>count($recever_emails_array),
        ]);

//    dd($recever_emails);
        foreach ($recever_emails_array as $recever_email){
            if($recever_email == null){
                continue;
            }
            dispatch(new SendEmailJob(
                $recever_email,
                $sender_emails_array[rand(0,$total_sender_count)],
                $request->subject,
                $request->email_message,
                $job_id
            ));
        }


        return redirect()->back()->with('success' , 'Emails are sending in background');


    }
}
