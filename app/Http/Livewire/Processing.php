<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Processing extends Component
{

//    protected $listeners = ['refresh_processing' => 'render'];
    public $in_progress = true;
    public $total_emails = 0;
    public $sent_emails = 0;


    public function render()
    {
        $current_jobs = DB::table('progress')->where('user_id' , auth()->user()->id)->where('remaining_emails','>','0')->get();
        return view('livewire.processing' , compact('current_jobs'));
    }
}
