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

    $client_id =env('AZURE_CLIENT_ID', false);
    $pass = env('AZURE_PASS_KEY', false);
    $tenant_id = env('AZURE_TENANT_ID', false);

    // Password
    $clientSecret = urlencode($pass);
    // Information about the resource we need access for which in this case is graph.
    $graphId = 'https://management.core.windows.net/';

    $graphPrincipalId = urlencode($graphId);
    // Information about the app
    $clientPrincipalId = urlencode($client_id);

    // Construct the body for the STS request
    $authenticationRequestBody = 'grant_type=client_credentials&client_secret='.$clientSecret
        .'&'.'resource='.$graphPrincipalId.'&'.'client_id='.$clientPrincipalId;

    //Using curl to post the information to STS and get back the authentication response
    $ch = curl_init();
    // set url
    $stsUrl = 'https://login.microsoftonline.com/'.$tenant_id.'/oauth2/token';
    curl_setopt($ch, CURLOPT_URL, $stsUrl);
    // Get the response back as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Mark as Post request
    curl_setopt($ch, CURLOPT_POST, 1);
    // Set the parameters for the request
    curl_setopt($ch, CURLOPT_POSTFIELDS,  $authenticationRequestBody);

    // By default, HTTPS does not work with curl.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // read the output from the post request
    $output = curl_exec($ch);
    // close curl resource to free up system resources
    curl_close($ch);
    // decode the response from sts using json decoder
    $tokenOutput = json_decode($output);

    var_dump($tokenOutput);
    echo "<br><br>";

    $cha = curl_init();
    $api_version = '?api-version=2015-01-01';
    $url = "https://management.azure.com/subscriptions/SUBSCRIPTION_ID/resourcegroups";

    $auth = 'Authorization:' . $tokenOutput->{'token_type'}.' '.$tokenOutput->{'access_token'};
    // Add authorization and other headers. Also set some common settings.
    curl_setopt($cha, CURLOPT_HTTPHEADER, array($auth,  'Content-Type: application/json'));
    // Set the option to recieve the response back as string.
    curl_setopt($cha, CURLOPT_RETURNTRANSFER, 1);
    // By default https does not work for CURL.
    curl_setopt($cha, CURLOPT_SSL_VERIFYPEER, false);
    // set url
    $feedURL = "https://management.azure.com/subscriptions".$api_version;
    curl_setopt($cha, CURLOPT_URL, $feedURL);

    // $output contains the output string
    $output = curl_exec($cha);
    // close curl resource to free up system resources
    curl_close($cha);
    $jsonOutput = json_decode($output);
    // There is a field for odata metadata that we ignore and just consume the value
    var_dump($jsonOutput);

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


