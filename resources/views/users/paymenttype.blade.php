@extends('layouts.app')

@section('content')
<style>
.div1 {
  width: 300px;
  height: 100px;

  box-sizing: border-box;
}
.div1 img{

    width: 200px;

}
.div2 {
  width: 300px;
  height: 100px;

  box-sizing: border-box;
}
.div2 a{
    border:double;
}
.div2 img{

    width: 200px;
    height:90px;
}
</style>

    <section id="emailSection" class="bg-light px-5 pt-3 pb-5 rounded mt-3">
        <h3>Select Payment type</h3>
          @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('success');?>
                @endif

                @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif
        <div style="display: flex;
        align-items: baseline;
        justify-content: space-evenly;">
            <div class="div1">
             <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label d-none">Enter Amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control d-none" name="amount" value="50" autofocus>

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
    </section>
@endsection
