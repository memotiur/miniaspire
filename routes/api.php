<?php

use Illuminate\Http\Request;


Route::post('/user/save', 'ApiController@newUser');
Route::post('/loan/save', 'ApiController@saveLoan');
Route::post('/repayment/save', 'ApiController@saveRepayment');

