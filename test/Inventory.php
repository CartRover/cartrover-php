<?php

require_once dirname(__FILE__).'/../lib/cartrover.php';

$api_user = 'TEST1';
$api_key = 'TEST1';

$cartrover = new \CartRover\cartrover($api_user, $api_key);

echo "First 20 Products:\n";
try{
	$inventory = $cartrover->ListInventory();
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}

print_r($inventory);

echo "\n\nSpecific Product:\n";

try{
	$product = $cartrover->GetProdInventory('C100');
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}

print_r($product);