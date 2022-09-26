<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('customer/contacts', 'ApiController@getAllCustomerContacts');

Route::get('customer/contacts/{id}', 'ApiController@getCustomerContact');

Route::post('customer/contacts', 'ApiController@createCustomerContact');

Route::put('customer/contacts/{id}', 'ApiController@updateCustomerContact');

Route::delete('customer/contacts/{id}','ApiController@deleteCustomerContact');

Route::put('customer/contacts/blacklist/{id}', 'ApiController@blacklistCustomerContact');