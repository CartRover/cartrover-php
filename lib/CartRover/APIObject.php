<?php

namespace CartRover;

class APIObject {
	
	private static $api_base = 'https://api.cartrover.com/';
	private static $api_version = 'v1';
	
	/**
	 * Actually perform API Call and return result
	 * @param string $endpoint
	 * @param array $post_array
	 * @throws CRError
	 * @return mixed "response" portion Response as array or TRUE if successful but no "response" portion.
	 */
	protected static function make_api_call($api_user, $api_key, $endpoint, $post_array=null, $get_array=array()){
		
		$url = APIObject::$api_base . APIObject::$api_version . $endpoint.'?'.http_build_query(
				array_merge(
					array(
						'api_user' => $api_user,
						'api_key' => $api_key
					),
					$get_array
				)
			);
		
		$header = array(
			'User-Agent: CartRover PhpClient/'.APIObject::$api_version,
			'Content-type: application/json'
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if($post_array){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_array));
		}
		
		$responseBody = curl_exec($ch);
		$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if($responseBody === false){
			$errno = curl_errno($ch);
			$error = curl_error($ch);
			curl_close($ch);
			APIObject::curlError($errno, $error);
		}
		
		curl_close($ch);
		
		$jsonPayload = json_decode($responseBody, true);
		
		// Catch error or invalid response 
		if(empty($jsonPayload) || empty($jsonPayload['success_code']) || $http_status > 400){
			throw new CRError($jsonPayload['message'], $http_status, $responseBody);
		}
		
		return (!empty($jsonPayload['response'])) ? $jsonPayload['response'] : true;
	}
	
	/**
	 * Format curl error and throw standardized error
	 * @param int $errno
	 * @param string $message
	 * @throws CRError
	 */
	protected static function curlError($errno, $message)
	{
		switch ($errno) {
			case CURLE_COULDNT_CONNECT:
			case CURLE_COULDNT_RESOLVE_HOST:
			case CURLE_OPERATION_TIMEOUTED:
				$msg = 'Could not connect to CartRover ('.APIObject::$api_base.'). Please check your internet connection and try again. If this problem persists please let us know at help@cartrover.com';
				break;
			case CURLE_SSL_CACERT:
			case CURLE_SSL_PEER_CERTIFICATE:
				$msg = 'Could not verify CartRover\'s SSL certificate. Make sure you can access '.APIObject::$api_base.' in your browser and that your SSL version supports SNI. If this problem persists, let us know at help@cartrover.com';
				break;
			default:
				$msg = 'Unexpected error communicating with CartRover. If this problem persists please let us know at help@cartrover.com';
		}
		$msg .= "\nNetwork error [errno {$errno}]: {$message})";
		throw new CRError($msg);
	}
	
}