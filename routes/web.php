<?php

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


Route::get('/', 'HomeController@index');
Route::get('/login', function () {
    return view('pages.login.login');
});


Route::get('/user/register', 'HomeController@register');
Route::post('/user/store', 'HomeController@store');
Route::get('/user/login', 'HomeController@login');
Route::post('/user/login-check', 'HomeController@doLogin');
Route::get('/user/logout', 'HomeController@doLogout');


//After Logged in
Route::get('/home', 'LoanController@index');

//Loan
Route::post('/loan/store', 'LoanController@store');
Route::get('/loan/show', 'LoanController@show');
Route::get('/loan/pay/{id}', 'LoanController@pay');
Route::get('/loan/details/{id}', 'LoanController@details');

//Repayment

Route::post('/repayment/store', 'RepaymentController@store');
