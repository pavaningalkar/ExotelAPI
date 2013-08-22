<?php

/**
	Implementation of a DND scrubber using Exotel's Metadata API. 
	Author: shivku
**/


$numbers = file("/path/to/my/numbers.txt");
$dnd_free_numbers = array();
 
$exotel_sid = "xxxx"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
$exotel_token = "xxxx"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings

foreach($numbers as $number) {

	$number = trim($number); 
	$url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Numbers/$number";

	echo "Checking if $number is DND or not...\n";
 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
	$http_result = curl_exec($ch);
	$error = curl_error($ch);
	$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	if($error) continue; 

	$xml = simplexml_load_string($http_result);
	if(isset($xml->RestException->Status) && $xml->RestException->Status == 401) {
		exit('Authentication failed');
	} 
	if($xml->Numbers->DND != "Yes") {
		$dnd_free_numbers[] = "$number\n";
	}

	sleep(3); //Just so we don't trigger Exotel server's spam buttons..
}

file_put_contents("/path/to/my/dnd_free_numbers.txt", $dnd_free_numbers);

?>
