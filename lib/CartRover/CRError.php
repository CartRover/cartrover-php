<?php

namespace CartRover;

class CRError extends \Exception
{
	
	private $errorLevel;
	private $additionalInfo;
	
    public function __construct($message = null, $httpStatus = null, $httpBody = null)
    {
		if(empty($message)){
			$message = 'CartRover API Error. Check HTTP Status and Body.';
		}
        parent::__construct($message);
        $this->httpStatus = $httpStatus;
        $this->httpBody = $httpBody;
        $this->additionalInfo = array();

        try {
            $jsonPayload = json_decode($httpBody, true);
			
			if(!empty($jsonPayload['error_code'])){
				$this->errorLevel = $jsonPayload['error_code'];
			}
			
			if(!empty($this->jsonPayload['error_response'])){
				$this->additionalInfo = $jsonPayload['error_response'];
			}
        } catch (\Exception $e) {
            $jsonPayload = null;
        }
    }

	/**
	 * Get HTTP Status code returned by CartRover
	 * @return int
	 */
    public function getHttpStatus()
    {
        return intval($this->httpStatus);
    }

	/**
	 * Get the full body of the CartRover server response
	 * @return string
	 */
    public function getHttpBody()
    {
        return $this->httpBody;
    }
	
	/**
	 * Get the error level as reported by CartRover
	 * @return string
	 */
	public function getErrorLevel()
    {
		return $this->errorLevel;
	}
	
	/**
	 * Get an array of additional info if provided by CartRover response
	 * @return array
	 */
	public function getAdditionalInfo(){
		return $this->additionalInfo;
	}
}