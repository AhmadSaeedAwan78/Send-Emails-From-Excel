@extends('layouts.app')

@section('content')


    <section id="emailSection" class="bg-light px-5 pt-3 pb-5 rounded mt-3">
        @livewire('processing')
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" style="width: 100%;" role="alert">
                 {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <!-- drag drop boxes -->
            <form class="row rounded" method="POST" action="{{ url('send-emails') }}"  enctype="multipart/form-data">
                @csrf
            <div
                class="
            col-md-6
            d-flex
            justify-content-center
            align-items-center
            flex-column
            emailBox
            rounded
          "
            >
                <label for="file" class="col-md-4 col-form-label text-md-right"></label>
                <p>Drag here to upload</p>
                <p>or</p>
                 <input id="" type="file" class="form-control form-control-file @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" required autocomplete="file" autofocus>
                       @error('file')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                <p class="display-6 h5"><strong>Sender</strong></p>




            </div>
            <div
                class="
            col-md-6
            d-flex
            justify-content-center
            align-items-center
            flex-column
            emailBox
            rounded
          "
            >
                <p>Drag here to upload</p>
                <p>or</p>
{{--                <p class="h5" style="color: red"><strong><input type="file" class="form-control-file"></strong></p>--}}
                <input id="" type="file" class="form-control form-control-file @error('receiver_file') is-invalid @enderror" name="receiver_file" value="{{ old('receiver_file') }}" required autocomplete="receiver_file" autofocus>
                @error('receiver_file')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
                @enderror
                <p class="display-6 h5"><strong>Recever</strong></p>
            </div>
            <div class="col-md-12 mb-3 mt-5">
                <label for="subject" class="form-label">Subject</label>
                <input id=""  placeholder="Enter subject" type="text" class="form-control  @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>
                @error('subject')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <label for="email_message" class="form-label">Message</label>
                <textarea class="form-control   @error('email_message') is-invalid @enderror" required name="email_message"
                    aria-label="With textarea"
                    style="resize: none"
                ></textarea>
                @error('email_message')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="col-md-2 btn btn-primary">Submit</button>
        </form>
    </section>
@endsection
