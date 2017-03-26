<?php
include("../config.inc.php");

// always start the session
session_start();

function getConnection() {
	
	// call global variable from outside the function
	global $db_host, $db_user, $db_pass, $db_database;
	
	
	$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);

	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
	return $mysqli;
}


// Taken from http://www.the-art-of-web.com/php/blowfish-crypt/
// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.

function better_crypt($input, $rounds = 7)
{
$salt = "";
$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
for($i=0; $i < 22; $i++) {
  $salt .= $salt_chars[array_rand($salt_chars)];
}
return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
}


function getGeoCode($postcode){
	
	//$output = array();
	
	// stripping whitespace or googlemaps will throw an error
	// storing value to aid readability
	$tags = $postcode;
	// then using string replacement
	$tags = str_replace (" ", "", $tags);
	
	// echo $tags;
	
	// NB this is using a V3 service
	$request = "http://maps.googleapis.com/maps/api/geocode/xml?address=$tags&sensor=false";
	
	// for more on cURL see http://php.net/manual/en/book.curl.php and http://blog.unitedheroes.net/curl/
	
	$crl = curl_init(); // creating a curl object
	$timeout = 10;
	curl_setopt ($crl, CURLOPT_URL,$request);
	curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	//
	$xml_to_parse = curl_exec($crl); 
	curl_close($crl); // closing the curl object
	
	// parsing
	$xml = simplexml_load_string($xml_to_parse);
	
	//echo $xml->asXML();
	
	$lat = $xml->result->geometry->location->lat;
	$long = $xml->result->geometry->location->lng;
	$output = $lat.",".$long;
	return $output;
}

?>