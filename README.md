# cartrover-php
Extensiv Integration Manager (Formerly CartRover) is a service that lets you easily pull orders from most of the popular ecommerce shopping carts and marketplaces. This PHP Client Library provides easier access to the https://www.extensiv.com/extensiv-integration-manager API.

Official API endpoint: https://api.cartrover.com/

Official Documentation at: https://developers.cartrover.com/

Manual Installation
------------

 **Require Library**

```php
require_once "/path/to/lib/cartrover.php";
```

Usage
-------
```php
// Include the library
require_once '/path/to/lib/cartrover.php';

// Pass credentials to the constructor
$cartrover = new \CartRover\cartrover($api_user, $api_key);

// Call one of the API endpoints
echo "List of Order Sources:\n";
try{
	$sources = $cartrover->ListCarts();
} catch (\CartRover\CRError $ex) {
	// Be sure to catch any errors
	echo 'ERROR: '.$ex->getMessage()."\n";
	echo 'HTTP Status: '.$ex->getHttpStatus()."\n";
	echo 'HTTP Body: '.$ex->getHttpBody()."\n";
	exit(1);
}

// View the results
print_r($sources);

```
