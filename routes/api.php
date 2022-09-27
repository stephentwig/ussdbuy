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


Route::get('customer/contacts', 'ApiController@getAllCustomerContacts')->name('getAllCustomerContacts');

Route::get('customer/contacts/{id}', 'ApiController@getCustomerContact')->name('getCustomerContact');

Route::get('customer/contacts/isblacklisted/{contact_number}', 'ApiController@is_blacklisted')->name('is_blacklisted');

Route::post('customer/contacts', 'ApiController@createCustomerContact')->name('createCustomerContact');

Route::put('customer/contacts/{id}', 'ApiController@updateCustomerContact')->name('updateCustomerContact');

Route::delete('customer/contacts/{id}','ApiController@deleteCustomerContact')->name('deleteCustomerContact');

Route::patch('customer/contacts/blacklist/{id}', 'ApiController@blacklistCustomerContact')->name('blacklistCustomerContact');