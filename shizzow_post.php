<?php

require_once $_SERVER["DOCUMENT_ROOT"] ."/shz/shizzow_login.php";


//  https://v0.api.shizzow.com/places/{places_key}/shout


$places_key = $_POST['places_key'];

$postfields = '"places_key="' .places_key . '"';


$url = 'https://v0.api.shizzow.com/places/' . $places_key . '/shout';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BA1SIC);
curl_setopt($curl, CURLOPT_USERPWD, $usrpwd);
$curl_response = curl_exec($curl);
curl_close($curl);



$data = json_decode($curl_response);
//var_dump($data);


//echo ("<pre>" . print_r($data, true) . "</pre>");
   
  
?> 