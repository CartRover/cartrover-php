<?php

namespace CartRover;

class Orders extends APIObject {
	
	/**
	 * Insert one or more orders into CartRover
	 * @param string $api_user
	 * @param string $api_key
	 * @param array $orders_array Array of orders, even if only one
	 * @return array
	 */
	public static function CreateOrders($api_user, $api_key, $orders_array){
		$endpoint = '/cart/orders/cartrover';
		return APIObject::make_api_call($api_user, $api_key, $endpoint, $orders_array);
	}
	
	/**
	 * Cancel an order in CartRover. This may fail if you wait too long to cancel the order after its creation
	 * @param string $api_user
	 * @param string $api_key
	 * @param array $cust_ref cust_ref of order to cancel
	 * @return array
	 */
	public static function CancelOrder($api_user, $api_key, $cust_ref){
		$endpoint = '/cart/orders/cancel/cartrover';
		$post_array = array(
			array(
				'cust_ref' => $cust_ref
			)
		);
		return APIObject::make_api_call($api_user, $api_key, $endpoint, $post_array);
	}
	
}