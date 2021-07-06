@extends('layouts.app')

@section('content')
<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
crossorigin="anonymous">

    <div class='pt-md-5'>
        <div class='col-md-3'></div>
        <div class='col-md-6'>
            <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
            <form accept-charset="UTF-8" action="/payment_single" class="require-validation"
                data-cc-on-file="false"
                data-stripe-publishable-key="pk_test_51J7cw6IGbfgby5YXwJO1pa4fmUQakZoeUyheNrnhh5e3mhYMAIn8ICWEXzBvGDAxkMn5EZubtQy0ufEtJmtKqdXX00TWaoflsa"
                id="payment-form" method="POST">
                {{ csrf_field() }}
<?php
    $amount=DB::table('package_subscriptions')->where('name','Monthly')->pluck('amount')->first();
     ?>
     <input type="hidden" name="amount" value="{{ $amount }}">
                <div class='form-row'>
                    <div class='col-xs-12 form-group required'>
                        <label class='control-label'>Name on Card</label> <input
                            class='form-control' size='4' type='text'>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='col-xs-12 form-group required'>
                        <label class='control-label'>Card Number</label> <input
                            autocomplete='off' class='form-control card-number' size='20'
                            type='text'>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='col-xs-4 form-group cvc required'>
                        <label class='control-label'>CVC1</label> <input
                            autocomplete='off' class='form-control card-cvc'
                            placeholder='ex. 311' size='4' type='text'>
                    </div>
                    <div class='col-xs-4 form-group expiration required'>
                        <label class='control-label'>Expiration</label> <input
                            class='form-control card-expiry-month' placeholder='MM' size='2'
                            type='text'>
                    </div>
                    <div class='col-xs-4 form-group expiration required'>
                        <label class='control-label'> </label> <input style='margin-top: 5px;'
                            class='form-control card-expiry-year' placeholder='YYYY'
                            size='4' type='text'>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='col-md-12 text-center'>

                    </div>
                </div>
                <div class='form-row mt-4'>
                    <div class='col-md-12 text-center form-group'>
                        <button class=' btn btn-primary px-5 submit-button'
                            type='submit' >Pay $ {{ $amount }}</button>

                    </div>
                </div>

                <div class='form-row'>
                    <div class='col-md-12 error form-group hide'>
                        <div class='alert-danger alert'>Please correct the errors and try
                            again.</div>
                    </div>
                </div>
            </form>
            @if ((Session::has('success-message')))
            <div class="alert alert-success col-md-12">{{
                Session::get('success-message') }}</div>
            @endif @if ((Session::has('fail-message')))
            <div class="alert alert-danger col-md-12">{{
                Session::get('fail-message') }}</div>
            @endif
        </div>
        <div class='col-md-3'></div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
$(function() {
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(e.target).closest('form'),
            inputSelector = ['input[type=email]', 'input[type=password]',
            'input[type=text]', 'input[type=file]',
            'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid         = true;

        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');

        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault(); // cancel on first error
            }
        });
    });
});

$(function() {
    var $form = $("#payment-form");
    $form.on('submit', function(e) {
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form[0].submit();
        }
    }
})

</script>

@endsection
