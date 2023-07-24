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
	 * @param string $api_user
	 * @param string $api_key
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
		
		require(dirname(__FILE__) . '/CartRover/Merchant.php');
		require(dirname(__FILE__) . '/CartRover/Orders.php');
		require(dirname(__FILE__) . '/CartRover/OrderSource.php');
		require(dirname(__FILE__) . '/CartRover/WMS.php');
	}
	
	/**
	 * Return a list of all Carts (order sources) for this merchant
	 * @return array
	 */
	public function ListCarts(){
		return OrderSource::ListCarts($this->api_user, $this->api_key);
	}
	
	/**
	 * Return a list of all possible Carts that can be setup.
	 * @return array
	 */
	public function ListAllCarts(){
		return OrderSource::ListAllCarts($this->api_user, $this->api_key);
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
	 * @return array
	 */
	public function UpdateCartShipMethod($order_source, $cart_codes_array){
		return OrderSource::UpdateShipMethods($this->api_user, $this->api_key, $order_source, $cart_codes_array);
	}
	
	/**
	 * Insert one or more orders into CartRover
	 * @param array $orders_array Array of orders, even if only one. See here for format: https://cartrover.atlassian.net/wiki/pages/viewpage.action?pageId=3997742
	 * @return array
	 */
	public function CreateOrders($orders_array){
		return Orders::CreateOrders($this->api_user, $this->api_key, $orders_array);
	}
	
	/**
	 * Cancel an order in CartRover. This may fail if you wait too long to cancel the order after its creation
	 * @param array $cust_ref cust_ref of order to cancel
	 * @return array
	 */
	public function CancelOrder($cust_ref){
		return Orders::CancelOrder($this->api_user, $this->api_key, $cust_ref);
	}
	
	/**
	 * View an order in CartRover.
	 * @param string $cust_ref cust_ref of order to view
	 * @return array
	 */
	public function ViewOrder($cust_ref){
		return Orders::ViewOrder($this->api_user, $this->api_key, $cust_ref);
	}
	
	/**
	 * Return a list of all products/inventory
	 * @param array $get_params Notably limit and page. Default: array('limit'=>20, 'page'=>1)
	 * @return array
	 */
	public function ListInventory($get_params=array('limit'=>20, 'page'=>1)){
		return Merchant::ListInventory($this->api_user, $this->api_key, $get_params);
	}
	
	/**
	 * Return a specific product
	 * @param string $sku Product to lookup
	 * @return array
	 */
	public function GetProdInventory($sku){
		return Merchant::GetProdInventory($this->api_user, $this->api_key, $sku);
	}
}
