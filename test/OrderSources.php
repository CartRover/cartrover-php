<?php

require_once dirname(__FILE__).'/../lib/cartrover.php';

$api_user = 'TEST1';
$api_key = 'TEST1';

$cartrover = new \CartRover\cartrover($api_user, $api_key);

echo "Order Sources:\n";
try{
	$sources = $cartrover->ListCarts();
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}

print_r($sources);

echo "\n\nCart Ship Mithods:\n";

try{
	$methods = $cartrover->ListCartShipMethods('Amazon');
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}

print_r($methods);

echo "\n\nUpdate Cart Ship Mithods:\n";

$new_methods = array(
	array('cart_code' => 'Express', 'wms_code' => '22'),
	array('cart_code' => 'Standard', 'wms_code' => '01'),
	array('cart_code' => 'AddMe', 'wms_code' => NULL)
);
try{
	$result = $cartrover->UpdateCartShipMethod('Amazon', $new_methods);
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}

if($result){
	echo "\tUpdated!";
}
else{
	echo "\tUpdate failed!";
}

echo "\n\nNEW Cart Ship Mithods:\n";

try{
	$methods = $cartrover->ListCartShipMethods('Amazon');
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}

print_r($methods);