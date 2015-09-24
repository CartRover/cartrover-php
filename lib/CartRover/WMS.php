<?php

namespace CartRover;

class WMS extends APIObject{
	
	/**
	 * Return a list of all ship methods setup for this WMS
	 * @param string $api_user
	 * @param string $api_key
	 * @return array
	 */
	public static function ListShipMethods($api_user, $api_key){
		$endpoint = '/wms/shipmethod/list';
		return APIObject::make_api_call($api_user, $api_key, $endpoint);
	}
	
}