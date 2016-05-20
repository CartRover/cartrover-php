<?php

namespace CartRover;

class Merchant extends APIObject {
	
	/**
	 * Return a list of all products/inventory
	 * @param string $api_user
	 * @param string $api_key
	 * @param array $get_params Notably limit and page. Default: array('limit'=>20, 'page'=>1)
	 * @return array
	 */
	public static function ListInventory($api_user, $api_key, $get_params=array('limit'=>20, 'page'=>1)){
		$endpoint = '/merchant/inventory';
		return APIObject::make_api_call($api_user, $api_key, $endpoint, null, $get_params);
	}
	
	/**
	 * Return a specific product
	 * @param string $api_user
	 * @param string $api_key
	 * @param string $sku Product to lookup
	 * @return array
	 */
	public static function GetProdInventory($api_user, $api_key, $sku){
		$endpoint = '/merchant/inventory/'.$sku;
		return APIObject::make_api_call($api_user, $api_key, $endpoint);
	}
	
}