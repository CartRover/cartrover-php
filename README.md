# cartrover-php
CartRover is a service that lets you easily pull orders from most of the popular ecommerce shopping carts and marketplaces. This PHP Client Library provides easier access to the https://CartRover.com API.

Installation
------------

 **Require Library**

```php
require_once "/path/to/lib/cartrover.php";
```

Usage
-------
```php
require_once /path/to/lib/cartrover.php';

$cartrover = new \CartRover\cartrover($api_user, $api_key);

echo "List of Order Sources:\n";
try{
	$sources = $cartrover->ListCarts();
} catch (\CartRover\CRError $ex) {
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}

print_r($sources);

```
