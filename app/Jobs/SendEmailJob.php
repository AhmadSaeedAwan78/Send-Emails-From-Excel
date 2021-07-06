<?php

namespace App\Jobs;

use App\Mail\SendEmails;
use App\Mail\SendEmailTest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Livewire\Processing as processing_class;
use Swift_Mailer;
use Swift_SmtpTransport;


class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $recever_email;
    public $sender_email;
    public $subject;
    public $email_message;
    public $job_id;
    public $sender_password;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recever_email , $sender_email,$sender_password, $subject, $email_message,$job_id)
    {
        //
        $this->sender_email = $sender_email;
        $this->sender_password = $sender_password;

        $this->recever_email = $recever_email;
        $this->subject = $subject;
        $this->email_message = $email_message;
        $this->job_id = $job_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $reciever_email = $this->recever_email;
       $sender_email = $this->sender_email;
       $sender_password = $this->sender_password;
       $subject = $this->subject;
       $job_id = $this->job_id;
       $email_message = $this->email_message;
       $in_progress = 1;
        $progress = DB::table('progress')->where('job_id' , $job_id)->first();
        $remaining_emails = $progress->remaining_emails;
        if($remaining_emails == 0){
            DB::table('progress')->where('job_id' , $this->job_id)->update([
                'in_progress' => 0,
            ]);
        }
        else{
            $data = array('email_subject'=> $subject , 'email_message' =>$email_message , 'url'=>$job_id);

            $transport = new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls');
            $transport->setUsername($sender_email);
            $transport->setPassword($sender_password);
            $swift_mailer = new Swift_Mailer($transport);
            Mail::setSwiftMailer($swift_mailer);
            Mail::send(['html'=>'emails.email_view'], $data, function($message) use($reciever_email , $sender_email, $subject ) {
                $message->to($reciever_email, 'Sample Message')->subject
                ($subject);
                $message->from($sender_email,$sender_email);
            });

            $remaining_emails = $remaining_emails-1;
            DB::table('progress')->where('job_id' , $this->job_id)->update([
                'remaining_emails' => $remaining_emails,
                'in_progress' => 1,
            ]);

        }



    }

    public function failed()
    {
        $progress = DB::table('progress')->where('job_id' , $this->job_id)->first();
        $remaining_emails = $progress->remaining_emails;
        if($remaining_emails == 0){
            DB::table('progress')->where('job_id' , $this->job_id)->update([
                'in_progress' => 0,
            ]);
        }else{
            $remaining_emails = $remaining_emails-1;
            DB::table('progress')->where('job_id' , $this->job_id)->update([
                'remaining_emails' => $remaining_emails,
                'in_progress' => 1,
            ]);
        }

    }
}
