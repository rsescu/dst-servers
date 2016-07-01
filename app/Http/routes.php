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

Route::get('/auth', function() {

    $subscription_id = "c677219f-0cde-4d57-8fc0-272dda524ae9";
    $resource_group_name = "DST_dedicated_server";
    $vm_name = "DSTGreiiGreilor";

    $vmOperator = new \App\Helpers\AzureVmOperationsHandler($subscription_id, $resource_group_name);
    $vm_info = $vmOperator->startVM($vm_name);
    
    var_dump($vm_info);

});
/*
 * POST /89d835ac-98f5-4a97-9389-fe67321c7e09/oauth2/token
Host: login.microsoftonline.com
Content-Type: application/x-www-form-urlencoded
Content-Length: 187
Cache-Control: no-cache
Postman-Token: 54980b86-aeda-c0d7-d67c-4655b1888bc9
grant_type=client_credentials&client_id=2e973fd7-a805-493c-b42b-260040b83369&resource=http%253A%252F%252Fdstserverdeploymentapp.azurewebsites.net&client_secret=tunDlWj6xIbQPhAuR%2BTqQAH69iSzbCndWjZyFTZJViY%3D
 */


