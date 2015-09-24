<?php

/*
 * Require this file to use library
 */

namespace CartRover;


class cartrover {
	
	private $api_user;
	private $api_key;
	
	/**
	 * Constructor sets API credentials
	 * @param type $api_user
	 * @param type $api_key
	 * @throws \Exception
	 */
	function __construct($api_user, $api_key){
		if (!function_exists('curl_init')) {
			throw new \Exception('CartRover requires the CURL PHP extension.');
		}
		if (!function_exists('json_decode')) {
			throw new \Exception('CartRover requires the JSON PHP extension.');
		}
		
		$this->api_user = $api_user;
		$this->api_key = $api_key;
		
		require(dirname(__FILE__) . '/CartRover/CRError.php');
		require(dirname(__FILE__) . '/CartRover/APIObject.php');
		
		require(dirname(__FILE__) . '/CartRover/OrderSource.php');
		require(dirname(__FILE__) . '/CartRover/WMS.php');
	}
	
	/**
	 * Return a list of all Carts (order sources) for this merchant
	 * @return array
	 */
	public function ListCarts(){
		return OrderSource::ListAll($this->api_user, $this->api_key);
	}
	
	/**
	 * Return a list of all ship methods setup for this WMS
	 * @return array
	 */
	public function ListWMSShipMethods(){
		return WMS::ListShipMethods($this->api_user, $this->api_key);
	}
	
	/**
	 * Return a list of all Ship Methods for the given Cart / Order Source.
	 * Also returns what WMS ship methods they are mapped to.
	 * @param string $order_source
	 * @return array
	 */
	public function ListCartShipMethods($order_source){
		return OrderSource::ListShipMethods($this->api_user, $this->api_key, $order_source);
	}
	
	/**
	 * Add or update the given list of ship methods.
	 * Post array takes a list of associative arrays each of which requires a cart_code. Can optionally pass a wms_code that it should be mapped to. Must be either a valid WMS Ship Method or NULL (for passthrough/no mapping)
	 * @param string $order_source
	 * @param array $cart_codes_array Array Format: [ { "cart_code": "Express", "wms_code": "20" }, { "cart_code": "Standard", "wms_code": NULL } ]
	 * @return type
	 */
	public function UpdateCartShipMethod($order_source, $cart_codes_array){
		return OrderSource::UpdateShipMethods($this->api_user, $this->api_key, $order_source, $cart_codes_array);
	}
	
}
