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
	}
	
	/**
	 * Return a list of all Carts (order sources) for this merchant
	 * @return array
	 */
	public function ListCarts(){
		return OrderSource::ListAll($this->api_user, $this->api_key);
	}
	
	public function ListWMSShipMethods(){
		//TODO: 
		//return WMS::ListShipMethods($this->api_user, $this->api_key);
	}
	
	public function ListCartShipMethods($order_source){
		return OrderSource::ListShipMethods($this->api_user, $this->api_key, $order_source);
	}
	
	public function UpdateCartShipMethod($order_source, $cart_codes_array){
		//TODO: 
		//return OrderSource::UpdateShipMethods($this->api_user, $this->api_key);
	}
	
}
