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

Route::get('/openings/{job_id?}', 'HistoryController@update_openings')->name('update-openings');
Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/send-emails', 'SendMailController@send_emails')->name('send-emails');
    Route::post('/send-emails', 'SendMailController@send_emails_job')->name('send-emails-job');
    Route::get('/history', 'HistoryController@index')->name('show-history');

    Route::get('/logout', function(){
        Auth::logout();
        return redirect('/login');
    })->name('log_out');
});

