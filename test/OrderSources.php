<?php

require_once dirname(__FILE__).'/../lib/cartrover.php';

$api_user = 'TEST1';
$api_key = 'TEST1';

$cartrover = new \CartRover\cartrover($api_user, $api_key);

try{
	$sources = $cartrover->ListCarts();
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus();
	echo 'HTTP Body: '.$ex->getHttpBody();
	exit(1);
}

print_r($sources);