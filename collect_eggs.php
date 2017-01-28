<?php

// collect_eggs.php
include '/var/www/html/oath/vendor/autoload.php';
use Guzzle\Http\Client;

// create our http client (Guzzle)
$http = new Client('http://coop.apps.knpuniversity.com', array(
    'request.options' => array(
        'exceptions' => false,
    )
));

// run this code *before* requesting the eggs-collect endpoint
$request = $http->post('/token', null, array(
    'client_id'     => 'Brent\'s Lazy CRON jon',
    'client_secret' => 'a6fb14a29ec8be1682b0cec2b4647830',
    'grant_type'    => 'client_credentials',
));

// make a request to the token url
$response = $request->send();
$responseBody = $response->getBody(true);
$responseArr = json_decode($responseBody, true);
$accessToken = $responseArr['access_token'];
//$accessToken = '49a5dbdb91fb10f770622471a2d7c18c7a125709';

$request = $http->post('/api/1371/eggs-collect');
$request->addHeader('Authorization', 'Bearer '.$accessToken);
$response = $request->send();
echo $response->getBody();

echo "\n\n";