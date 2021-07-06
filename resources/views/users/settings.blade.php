@extends('layouts.app')

@section('content')

<section id="profileSettings" class=" px-3 pt-3 pb-5 rounded mt-5">
    <form  class="row rounded p-4" action="update-setting" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12 mb-4">
            <p class="h3">Edit Profile</p>
        </div>

        @if(Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
        @endif
        <div class="mb-3 col-md-3">
            <label for="exampleInputEmail1" class="form-label">First Name</label>
            <input type="text" name="name" required value="{{Auth::user()->name}}" class="form-control" id="exampleInputEmail1" placeholder="Qavi">
        </div>
        <div class="mb-3 col-md-3">
            <label for="exampleInputEmail1" class="form-label">Phone</label>
            <input type="number" required value="{{Auth::user()->mobile}}" name="mobile" class="form-control" id="exampleInputEmail1" placeholder="03XXXXXXXXX">
        </div>
        <div class="mb-3 col-md-6">
            <label for="exampleInputEmail1" class="form-label">Instagram Acount</label>
            <input type="text" required name="instagram" value="{{Auth::user()->instagram}}" class="form-control" id="exampleInputEmail1" placeholder="xyz@instagram.com">
        </div>
        <div class="mb-3 col-md-6">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" required name="email" value="{{Auth::user()->email}}" class="form-control" id="exampleInputEmail1" placeholder="Your Email please!">
        </div>
        <div class="mb-3 col-md-6">
            <label for="exampleInputEmail1" class="form-label">Last Name</label>
            <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Password">
        </div>
        <div class="mb-3 col-md-12" style="
        text-align: center;
    ">
            <label for="exampleInputEmail1" class="form-label">Profile Image</label>
            <br>
            @if(Auth::user()->image==null)
            <img src="{{asset('images/users/dwayne-the-rock-.jpg')}}" width="100px">
          @else
            <img id="navLogo" src="{{asset('images/users/'.Auth::user()->image )}}"
                        alt="the rock"/>
                        @endif
                    </div>
                    <input type="file" name="image" class="form-control" id="exampleInputEmail1">
            <button style="margin-top: 32px !important;" type="submit" class="btn btn-primary mx-auto my-auto col-md-6">Update</button>
    </form>
</section>
@endsection
