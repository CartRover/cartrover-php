<?php

namespace CartRover;

class OrderSource extends APIObject {
	
	/**
	 * Return a list of all Carts (order sources) for this merchant
	 * @param string $api_user
	 * @param string $api_key
	 * @return array
	 */
	public static function ListAll($api_user, $api_key){
		$endpoint = '/cart/list';
		return APIObject::make_api_call($api_user, $api_key, $endpoint);
	}
	
	public static function ListShipMethods($api_user, $api_key, $order_source){
		$endpoint = '/cart/shipmethod/list';
		return APIObject::make_api_call($api_user, $api_key, $endpoint);
	}
	
}