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


Route::get('/auth', function() {
    $running = \App\Http\Controllers\ServerController::serverCommands("40.114.196.95", "screen -list");
    $aa = []; preg_match('/\d{3,6}\.(\d|\w)*\s*\(\d{2}\/\d{2}\/\d{4}\s\d{2}\:\d{2}\:\d{2}\s(PM|AM)\)/', $running, $aa);
    echo $running."<br>";
    var_dump($aa);
});

Route::put('/hosts/{vmName}/start', "HostsController@startHost");

Route::put('/hosts/{vmName}/stop', "HostsController@stopHost");

Route::put('/servers/{serverId}/start', "ServerController@startServer");

Route::put('/servers/{serverId}/stop', "ServerController@stopServer");



