<?php
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Credentials: true');
header('Access-COntrol-Allow-Headers: content-type,x-xsrf-token');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::resource('/gateway', 'GatewayAPI');

Route::get('/home', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});
Route::auth();

Route::get('/smses/queued', 'SMSController@getQueuedSmses');
Route::get('/smses/sent', 'SMSController@getSentSmses');
Route::get('/smses/new', 'SMSController@createNewSmses');
Route::post('/smses/new', 'SMSController@sendNewSmses');
Route::get('/contacts', 'ContactsController@getContacts');
Route::get('/contacts/add', 'ContactsController@createContacts');
Route::post('/contacts/add', 'ContactsController@storeContacts');
Route::get('/communities', 'CommunityController@getCommunities');
Route::post('/communities/add', 'CommunityController@createCommunities');

//http://localhost/innovators/public/api/contacts
Route::get('/api/contacts','Api\ApiContacts@getContacts');
Route::post('/api/contacts/add','Api\ApiContacts@storeContacts');

