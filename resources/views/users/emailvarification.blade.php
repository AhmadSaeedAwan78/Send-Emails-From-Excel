@extends('layouts.app')

@section('content')
    <section id="historySection" class="bg-light px-3 pt-3 pb-5 rounded mt-5">
<h3 class="text-center">Email varification</h3>       
       <div style=" width: 100%;padding: 50px;margin: 10px;">
        @if(Auth::user()->is_email_varified ==1)
                    <h4 style="line-height: 100%;">{{ __('Your email is verified')}}</h4>
                    
                    @else
              <h4 style="line-height: 100%;text-align: center;margin-top: 20px;">{{ __('Please check your email.')}} {{ __('A verification link sent to your email.')}} <br> <br>{{Auth::user()->email}} </h3>
              @endif
        </div>
      

    </section>

@endsection
