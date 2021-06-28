@extends('layouts.app')

@section('content')
    <section id="historySection" class="bg-light px-3 pt-3 pb-5 rounded mt-5">
        <div class="h3">History</div>
        <div>
            <p class="ms-auto"><b>{{$opened}}</b> mails are opened out of {{$total_sent}}</p>
        </div>
        <div id="bulkHistory" class="row rounded p-3">
            <div class="d-flex justify-content-center mb-2 flex-column flex-end">
                <p class="h3 col-md-6">Last Bulk History</p>
            </div>

            @foreach($history as $data)
            <div class="card d-flex flex-row p-2 my-2 bg-light rounded" style="width: 100%;">
                <div class="cardImg my-auto ">
                    <small style="color: #1b1e21">Sender File</small>
                    <a href="{{asset('/files/'.$data->sender_file_name)}}" download"><img src="{{asset('/images/excel.png')}}" class="card-img-top img-fluid" alt="..."></a>
                </div>
                <div class="cardImg my-auto ml-3 ">
                    <small style="color: #1b1e21">Reciever File</small>
                    <a href="{{asset('/files/'.$data->receiver_file_name)}}" download"><img src="{{asset('/images/excel.png')}}" class="card-img-top img-fluid" alt="..."></a>
                </div>
                <div class="card-body d-flex justify-content-center flex-column">
                    <h5 class="card-title mb-3">{{$data->subject}}</h5>
                    <p>{{$data->message}}</p>
                    <div class="d-flex justify-content-center">
                        <div>
                            <h4 class="m-0 p-0"><strong>{{$data->total_emails}} Emails</strong></h4>
                            <p class="m-0 p-0">DELIVERED</p>
                            <small class="m-0 p-0"> Job Id: {{$data->job_id}}</small>
                        </div>
                        <div class="ms-auto">
                            <h4 class="m-0 p-0"><strong>{{$data->openings}}</strong></h4>
                            <p class="m-0 p-0">Opened</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- BOTTOM PART OF HISTORY -->
            <div class="d-flex justify-content-space-evenly align-items-center flex-column">

                <div class="ms-auto">
                    {!! $history->links() !!}

                </div>
            </div>
        </div>

    </section>

@endsection
