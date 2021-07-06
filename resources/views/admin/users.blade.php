@extends('layouts.app')

@section('content')

<section id="profileSettings" class=" px-3 pt-3 pb-5 rounded mt-5">
    <div class="col-md-12 mb-4">
        <p class="h3">Users</p>
        <a style="margin-left: 90%;" class="btn btn-danger" data-toggle="modal" data-target="#form" >Add User</a>
        @error('email')
        <span class="invalid-feedback" role="alert" style="display: flex !important;
    ">
           <strong>{{ $message }}</strong>
             </span>
        @enderror
      </div>

  <div class="table-responsive-sm">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Firstname</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Email verified</th>
          <th>Expiry date</th>
          <th>Subscription</th>
          <th>Payment type</th>
          <th>Amount</th>
          <th>Image</th>
          <th>Delete</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $number=0;
        ?>
          @foreach($users as $key => $value)
          <?php
          $number++;
          $expirydate=DB::table('purchased_plans')->where('user_id',$value->id)->first();
          ?>
        <tr class="text-center">
          <td>{{ $number }}</td>
          <td>{{ $value->name }}</td>
          <td>{{ $value->email }}</td>
          <td>{{ $value->mobile }}</td>
          <td>@if($value->email_verified_at==0) No @else Yes @endif</td>
          <td>{{ isset($expirydate->expirey_date)?$expirydate->expirey_date:'No Package Selected'  }}</td>
          <td>@if($value->package_status==0)
                  No Package Selected
                   <form id="{{ $value->id }}form" action="{{ url('subbyadmin') }}" method="POST">
                      @csrf
                      <input type="date" class="form-control" onchange="$('#{{ $value->id }}form').submit()" name="ex_date">
                      <input type="hidden" name="user_id" value="{{ $value->id }}" >

                   </form>

              @else
              Active
              <a href="Cancelplan/{{$value->id }}" class="btn btn-sm btn-danger">Cancel</a>
              @endif
              </td>
              <td>{{ isset($expirydate->plan_type)?$expirydate->plan_type:'No Plan' }}</td>

          <td>{{ isset($expirydate->amount)?$expirydate->amount:'No Plan' }}</td>
              <td>@if($value->image==null)
            <img src="{{asset('images/users/dwayne-the-rock-.jpg')}}" style="width: 100px;">
          @else
          <img src="{{asset('images/users/'.$value->image )}}" style="width: 100px;"> @endif</td>


          <td><a href="delete-user/{{$value->id}}" class="btn btn-danger">Delete</a></td>

        </tr>
        @endforeach
      </tbody>
    </table>
    </div>

<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="adduser" method="post" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
              <div class="form-group">
                <label for="Name">Full Name</label>
                <input type="text" class="form-control" required name= "name" placeholder="Full Name">
              </div>

            <div class="form-group">
              <label for="email1">Email address</label>
              <input type="email" name="email" required class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="password1">Password</label>
              <input type="password" name="password" required class="form-control" id="password1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password1">Mobile</label>
                <input type="number" name="mobile" required class="form-control" id="password1" placeholder="Mobile">
              </div>
          <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



</section>
@endsection
