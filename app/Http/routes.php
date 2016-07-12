<?php
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

Route::auth();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index');

Route::get('/servers', "ServerController@index");

Route::get('/hosts', "HostsController@index");

Route::put('/hosts/{vmName}/start', "HostsController@startHost");

Route::put('/hosts/{vmName}/stop', "HostsController@stopHost");

Route::put('/servers/{serverId}/start', "ServerController@startServer");

Route::put('/servers/{serverId}/stop', "ServerController@stopServer");



