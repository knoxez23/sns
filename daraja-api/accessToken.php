<?php

$consumerKey = "ya7Xvi5jE8Gh3TdrDBqiCxmAAVdTLY9t";
$consumerSecret = "rzpAHbg4RA9PEfcA";

$encoded = base64_encode("$consumerKey:$consumerSecret");

$ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic '.$encoded]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = json_decode(curl_exec($ch));
curl_close($ch);

$access_token = $response->access_token;