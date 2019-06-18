<?php

$post_data = array(
    'From' => "<First-phone-number-to-call (Your agent's number)>",
    'To' => "<Second-phone-number-to-call (Your customer's number)>",
    'CallerId' => "<Your-Exotel-virtual-number>",
    'TimeLimit' => "<time-in-seconds> (optional)",
    'TimeOut' => "<time-in-seconds (optional)>",
    'CallType' => "promo" //Can be "trans" for transactional and "promo" for promotional content
);
 
// You can get your $exotel_sid, $api_key and $api_token from: https://my.exotel.com/apisettings/site#api-credentials 
$api_key = "xxxxx"; // Your `API KEY`.
$api_token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"; // Your `API TOKEN`
$exotel_sid = "xxxxxxxxxxx" // Your `Account Sid`
 
$url = "https://".$api_key.":".$api_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Calls/connect";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
 
$http_result = curl_exec($ch);
$error = curl_error($ch);
$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
 
curl_close($ch);
 
print "Response = ".print_r($http_result);

?>
