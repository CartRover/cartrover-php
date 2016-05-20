<?php

require_once dirname(__FILE__).'/../lib/cartrover.php';

$api_user = 'TEST1';
$api_key = 'TEST1';

$cartrover = new \CartRover\cartrover($api_user, $api_key);

$orders_array = array(
	array(
		'cust_ref' => 'TEST1',
		'ship_first_name' => 'Test First',
		'ship_last_name' => 'Test Last',
		'ship_address_1' => 'Test Addr 1',
		'ship_city' => 'Test City',
		'ship_state' => 'California',
		'ship_zip' => '93105',
		'ship_country' => 'USA',
		'ship_is_billing' => true,
		'items' => array(
			array(
				'item' => 'C100',
				'quantity' => 1,
				'price' => 23.15,
				'extended_amount' => 23.15,
			),
			array(
				'item' => 'C200',
				'quantity' => 6,
				'price' => 4.99,
				'extended_amount' => 29.94,
			),
		),
	)
);


try{
	$sources = $cartrover->CreateOrders($orders_array);
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}


/*
try{
	$sources = $cartrover->CancelOrder('TEST1');
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}
*/

print_r($sources);