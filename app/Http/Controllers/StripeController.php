<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Transfer;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Services\Stripe\Seller;
use Stripe\Charge;
use Stripe\Subscription;
use Stripe\Account;
use Auth;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class StripeController extends Controller
{
    public function create_connect_org() {


    $session = request()->session()->getId();
    $url = config('services.stripe.connect') . $session;

    return redirect($url);
}
public function save_org_connect_acc(Request $request){

    $this->validate($request, [
        'code' => 'required',
        'state' => 'required'
    ]);

    $client = new Client(['base_uri' => 'https://connect.stripe.com/oauth/']);
    $requests = $client->request("POST", "token", [
        'form_params' => [
            'client_secret' => 'sk_test_51J7cw6IGbfgby5YXXDDdtSjxZKCQE1taXrHEt12HPbTl3yxgnYbOd6oWuwqRrkhHyxHYnk5yEPXtloip7FGIkvYX00n4KCC6UT',
            'code' => $request->code,
            'grant_type' => 'authorization_code'
        ]
    ]);

    $data = json_decode($requests->getBody()->getContents());


    DB::table('users')->where('id', Auth::user()->id)->update([
        'stripe_connect_id' => $data->stripe_user_id,

    ]);



    return redirect('payment_screen/')->with('success', 'Account information has been saved.');
}
public function payment_screen(){


    return view('users.plans_screen_payment');
}

// Save Transaction Data Subscription
public function save_transaction(Request $request){

     $amount = $request->amount;

    Stripe::setApiKey(config('services.stripe.secret'));

    // $customer = \Stripe\Customer::create([
    //     'source' => $request->stripeToken,
    //     'email' => Auth::user()->email,

    // ]);

    //    $trial_exp_date = Carbon::now()->addMonth(1);
    //    $trail_end=strtotime($trial_exp_date);
    //    if($request->plan_id ==1){
    // $subscription = Subscription::create([
    //         'customer' => $customer->id,
    //         'items' => [
    //           [
    //             'price' => 'price_1J5bBNEHe3fYaiqPjYvNor70',
    //           ],
    //         ],
    //         'trial_end' => $trail_end,
    //     ]);
    //    }
    //    else{
    //         $subscription = Subscription::create([
    //         'customer' => $customer->id,
    //         'items' => [
    //           [
    //             'price' => 'price_1J5b9MEHe3fYaiqPJzf5hTkE',
    //           ],
    //         ],
    //         'trial_end' => $trail_end,
    //     ]);
    //    }



    $charge = Charge::create([
        'amount' => self::toStripeFormat($amount),
        'currency' => 'usd',
        "source" => $request->stripeToken, // obtained with Stripe.js
        "description" => "Subscription Bought"
    ]);
    $trial_exp_date = Carbon::now()->addMonth(1);

        $expirey_date = $trial_exp_date->toDateTimeString();

        if($charge){


        DB::table('purchased_plans')->insert([
            'plan_id' => 1,
            'user_id' => Auth::user()->id,
            'stripe_charge_id' => $charge->id,
            'amount' => $request->amount,
            'plan_type' => $charge->object,
            'expirey_date' => $expirey_date
        ]);
        DB::table('users')
        ->where('id', Auth::user()->id)
        ->update(['package_status' => 1]);

        return redirect('paymenttype')->with('success', 'Payment is Successfull');
    } else {
        return redirect('paymenttype')->with('error', 'Payment is not successfull');
    }

}
public static function toStripeFormat(float $amount){
    return $amount * 100;
}
}
