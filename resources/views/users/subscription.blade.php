@extends('layouts.app')

@section('content')
<style>
      .div1 img{
        width: 200px;
    }
    .div2 a{
        border:double;
    }
    .div2 img{
        width: 200px;
        height:90px;
    }
    </style>
    <!-- SUBSCRIPTION SECTION START -->
    <?php
                                    $amount=DB::table('package_subscriptions')->where('name','Monthly')->pluck('amount')->first();
                                     ?>
    <section id="subscriptionSection" class="px-3 pt-3 pb-5 rounded mt-5">
      <div class="col-md-12 mb-4">
        <p class="h1 mb-5">Upgrade your membership</p>
      </div>
      @if(Session::has('message'))
      <p class="alert alert-success">{{ Session::get('message') }}</p>
      @endif
      @if(Session::has('error'))
      <p class="alert alert-danger">{{ Session::get('error') }}</p>
      @endif
      <div id="subscriptionCards"
        class="d-flex mx-auto flex-column flex-md-row">

        <div class="card mx-auto" style="max-width: 26rem; min-width: 10rem">
          <div
            style="height: 10px; background-color: rgb(107, 0, 0)"
            class="w-100"
          ></div>
          <div class="card-body">
            <p style="color: rgb(0, 0, 0)" class="card-text packageName">Package detail</p>
            <h1 class="card-title">$ {{ $amount }}</h1>

            <div class="my-3">
              <i class="bx bx-user nav_icon"></i>
              <span class="nav_name"
                ><span id="begText">Unlimited emails</span>

            </div>
            <div class="my-3">
              <i class="bx bx-user nav_icon"></i>
              <span class="nav_name">One month subscription</span>
            </div>
            <div class="my-3">
              <i class="bx bx-user nav_icon"></i>
              <span class="nav_name">Standard Plan</span>
            </div>

          </div>
          <a data-toggle="modal" data-target="#checkpackage"
            class="btn btn-primary mb-3 w-75 mx-auto"
          >
            Subscribe
        </a>
        </div>
      </div>
      <div class="modal fade" id="checkpackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header border-bottom-0">
              <h5 class="modal-title" id="exampleModalLabel">Select Payment type</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

              <div class="modal-body">
                <div style="display: flex;
                align-items: baseline;
                justify-content: space-evenly;">
                    <div class="div1">
                     <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                    <label for="amount" class="col-md-4 control-label d-none">Enter Amount</label>

                                    <div class="col-md-6">
                                        <input id="amount" type="text" class="form-control d-none" name="amount" value="{{ $amount }}" autofocus>

                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" style="border: double;">
                    <img src="{{asset('images/payment/paypal.png')}}">

                                        </button>
                                    </div>
                                </div>
                            </form>
        </div>
                    <div class="div2">
                        @if(Auth::user()->stripe_connect_id == null)
                        <a class="btn" href="connect_org_first/">
                            <img src="{{asset('images/payment/stripe.png')}}"></a>
                      @else
                        <a class="btn" href="payment_screen/">
                            <img src="{{asset('images/payment/stripe.png')}}"></a>
                      @endif

                    </div>
        </div>

              </div>


          </div>
        </div>
      </div>


    </section>

    <!-------Paypal login form popup modal------------->
    <div id="id01" class="modal">
      <form
        id="paypalLoginForm"
        class="modal-content animate p-4"
        action="/login"
        method="post"
      >

        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="Credentials"
            id="paypal"
            checked
          />
          <label class="form-check-label" for="flexRadioDefault2">
            Paypal
          </label>
          <input
            id="paypalData"
            class="form-control"
            id="email"
            type="email"
            placeholder="Enter Email"
            name="email"
            required
          />
        </div>
        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="Credentials"
            id="creditCard"
          />
          <label class="form-check-label" for="flexRadioDefault1">
            Credit Card
          </label>
        </div>
        <div id="creditCardData" class="container d-none">
          <input
            class="form-control"
            id="cardNumber"
            type="text"
            placeholder="Card Number"
            name="email"
            required
          />
          <div class="row"></div>
          <input
            class="form-control col-md-6"
            type="text"
            placeholder="Expiry Date"
            name="expiryDate"
            required
          />
          <input
            class="form-control col-md-6"
            type="text"
            placeholder="CSV"
            name="csv"
            required
          />
        </div>

        <button id="paypalSubmitBtn" class="btn btn-primary mt-3" type="submit">
          <b>Login</b>
        </button>

        <a
          id="paypalCancelBtn"
          type="button"
          onclick="document.getElementById('id01').style.display='none'"
          class=""
        >
          X
        </a>
      </form>
    </div>
    <!--Container Main end-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script>document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId,logoId,link) =>{
        const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId),
        navLogo = document.getElementById(logoId)


        // Validate that all variables exist
        if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
        // show navbar
        nav.classList.toggle('show')
        // change icon
        toggle.classList.toggle('bx-x')
        // add padding to body
        bodypd.classList.toggle('body-pd')
        // add padding to header
        headerpd.classList.toggle('body-pd')
        console.log(navLogo);
        navLogo.classList.toggle('d-none')
        // links.forEach(element => {
        //     console.log(element);
        //     element.classList.toggle(' d-none');
        // });
        })
        }
        }

        showNavbar('header-toggle','nav-bar','body-pd','header','navLogo')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink(){
        if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
        }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
        });</script>
    <script>//Credit card related scripts
        let creditCard = document.getElementById("creditCard");
        creditCard.addEventListener("click", showCreditInputs);
        function showCreditInputs(e) {
          let creditCardData = document.getElementById("creditCardData");
          let paypalData = document.getElementById("paypalData");
          paypalData.classList.add("d-none");
          creditCardData.classList.remove("d-none");
        }

        //Paypal related script
        let paypal = document.getElementById("paypal");
        paypal.addEventListener("click", paypalInput);
        function paypalInput(e) {
          let creditCardData = document.getElementById("creditCardData");
          let paypalData = document.getElementById("paypalData");
          paypalData.classList.remove("d-none");
          creditCardData.classList.add("d-none");
        }
        </script>

@endsection
