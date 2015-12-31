<?php

namespace CartRover;

class OrderSource extends APIObject {
	
	/**
	 * Return a list of all Carts (order sources) for this merchant
	 * @param string $api_user
	 * @param string $api_key
	 * @return array
	 */
	public static function ListCarts($api_user, $api_key){
		$endpoint = '/cart/list';
		return APIObject::make_api_call($api_user, $api_key, $endpoint);
	}
	
	/**
	 * Return a list of all possible Carts that can be setup
	 * @param string $api_user
	 * @param string $api_key
	 * @return array
	 */
	public static function ListAllCarts($api_user, $api_key){
		$endpoint = '/cart/listall';
		return APIObject::make_api_call($api_user, $api_key, $endpoint);
	}
	
	/**
	 * Return a list of all Ship Methods for the given Cart / Order Source.
	 * Also returns what WMS ship methods they are mapped to.
	 * @param string $api_user
	 * @param string $api_key
	 * @param string $order_source
	 * @return array
	 */
	public static function ListShipMethods($api_user, $api_key, $order_source){
		$endpoint = '/cart/shipmethod/list/'.$order_source;
		return APIObject::make_api_call($api_user, $api_key, $endpoint);
	}
	
	/**
	 * Add or update the given list of ship methods.
	 * @param string $api_user
	 * @param string $api_key
	 * @param string $order_source
	 * @param array $cart_codes_array
	 * @return array
	 */
	public Static function UpdateShipMethods($api_user, $api_key, $order_source, $cart_codes_array){
		$endpoint = '/cart/shipmethod/'.$order_source;
		return APIObject::make_api_call($api_user, $api_key, $endpoint, $cart_codes_array);
	}
	
}