<?php

require_once $_SERVER["DOCUMENT_ROOT"] ."/shz/shizzow_login.php";


//  https://v0.api.shizzow.com/places/{places_key}/shout


$places_key = $_POST['places_key'];

if (!empty($_POST['shouts_message'])){
	$shouts_message = $_POST['shouts_message'];
}


$url = 'https://v0.api.shizzow.com/places/' . $places_key . '/shout';

echo "key: " . $places_key  . " url: " . $url . " shouts_message: " . $shouts_message . $PHP_EOL;

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $usrpwd);

    // PUT OPTIONS
clearstatcache();
$putString = "shouts_message=$shouts_message";
$putData = tmpfile();
fwrite($putData, $putString);
fseek($putData, 0);
curl_setopt($curl, CURLOPT_PUT, true);
curl_setopt($curl, CURLOPT_INFILE, $putData);
curl_setopt($curl, CURLOPT_INFILESIZE, strlen($putString));

$curl_response = curl_exec($curl);
curl_close($curl);

$data = json_decode($curl_response);
	var_dump($data);
	exit;

  
?> 