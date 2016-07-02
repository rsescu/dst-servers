<?php

namespace App\Helpers;

class AzureAuthenticator
{
    private static $resourceMap;
    private static $algorithm = "md5";

    public static function getAuthenticationToken($resource){
        $key = hash(self::$algorithm, $resource);
        if(isset(self::$resourceMap[$key])) {
            //token has been requested before for this resource
            //find out how long it is since the token was requested
            $elapsed_time = microtime(true) - self::$resourceMap[$key]["request_time"];
            if($elapsed_time < self::$resourceMap[$key]["token"]->expires_in ) {
                //token is still valid, return it
                return self::$resourceMap[$key]["token"];
            }
        }
        //no token exists or token is expired, request a new one and override the expired one
        //since key is new, just return it
        self::$resourceMap[$key] = self::requestAuthenticationToken($resource);
        if(!self::$resourceMap[$key]["token"]) {
            
        }
        return self::$resourceMap[$key]["token"];


    }


    private static function requestAuthenticationToken($resource){
        // Information about the resource we need access
        $resource = urlencode($resource);
        // Information about the app
        $client_id = env('AZURE_CLIENT_ID', false);
        $client = urlencode($client_id);
        // Password
        $pass = env('AZURE_PASS_KEY', false);
        $client_secret = urlencode($pass);
        // Tenant id
        $tenant_id = env('AZURE_TENANT_ID', false);
        // Construct the body for the STS request
        $authentication_request_body = 'grant_type=client_credentials'.
            '&client_secret='.$client_secret .
            '&resource='.$resource.
            '&client_id='.$client;
        //Using curl to post the information to STS and get back the authentication response
        $ch = curl_init();
        // set url
        $url = 'https://login.microsoftonline.com/'.$tenant_id.'/oauth2/token';
        curl_setopt($ch, CURLOPT_URL, $url);
        // Get the response back as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Mark as Post request
        curl_setopt($ch, CURLOPT_POST, 1);
        // Set the parameters for the request
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $authentication_request_body);
        // By default, HTTPS does not work with curl.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        $token_details["request_time"] = microtime(true);
        // close curl resource to free up system resources
        curl_close($ch);
        // decode the response from sts using json decoder
        $token_output = json_decode($output);
        $token_details["token"] = $token_output;
        return $token_details;
    }
}