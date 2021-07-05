<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', function () {
        return redirect('send-emails');
    });

    Route::get('/home', function () {
        return redirect('send-emails');
    });
    Route::post('reset-password','SettingController@resetPassword')->name('reset-password');
    Route::post('signup', 'SettingController@register');
    Route::get('/openings/{job_id?}', 'HistoryController@update_openings')->name('update-openings');
    Auth::routes();


    Route::group(['middleware' => ['auth']], function () {

    Route::get('confirmemail/{id}','SettingController@verification')->name('confirmemail');

    Route::get('/emailvarification', 'SettingController@emailvarification')->name('emailvarification');
    Route::get('/send-emails', 'SendMailController@send_emails')->name('send-emails');
    Route::post('/send-emails', 'SendMailController@send_emails_job')->name('send-emails-job');
    Route::get('/history', 'HistoryController@index')->name('show-history');

    Route::get('/logout', function(){
        Auth::logout();
        return redirect('/login');
    })->name('log_out');

//stripe
    Route::get('connect_org_first', 'StripeController@create_connect_org');
    Route::get('save_org_connect_acc', 'StripeController@save_org_connect_acc');
    Route::get('payment_screen', 'StripeController@payment_screen');
    Route::post('payment_single', 'StripeController@save_transaction');


    //paypal
    Route::get('paymenttype', array('as' => 'paymenttype','uses' => 'PaypalController@payWithPaypal',));
    Route::post('paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
    Route::get('paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));
});

