<div wire:poll.75ms>

    <div class="d-flex justify-content-center">



        <h3 class=" mb-3">Send Emails</h3>


    </div>
    @foreach($current_jobs as $curr_job)
        <?php
        $processed = $curr_job->total_emails - $curr_job->remaining_emails;
        ?>
        <div class="alert alert-success" role="alert">

            <h4 class="alert-heading">{{$processed}} out of {{$curr_job->total_emails}} Emails are Sent</h4>
            <hr>
            <h6>Details</h6>
            <ul>
                <li>Job ID: {{$curr_job->job_id}}</li>
                <li>Sender File: <a href="{{asset('public/files/'.$curr_job->sender_file_name)}}" download  >Download</a></li>
                <li>Receiver File: <a href="{{asset('public/files/'.$curr_job->receiver_file_name)}}" download  >Download</a></li>
            </ul>

        </div>

    @endforeach

</div>
