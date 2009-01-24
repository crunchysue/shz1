<?php
    

require_once $_SERVER["DOCUMENT_ROOT"] ."/shz/shizzow_login.php";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BA1SIC);
curl_setopt($curl, CURLOPT_USERPWD, $usrpwd);
$curl_response = curl_exec($curl);
curl_close($curl);

$data = json_decode($curl_response);
//var_dump($data);


//echo ("<pre>" . print_r($data, true) . "</pre>");
   
?>   