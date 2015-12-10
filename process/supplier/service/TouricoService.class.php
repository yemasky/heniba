<?php

/**
 * file_name 2015年12月3日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015
 */
class TouricoService{
	private $objWSClient;
	private $objProcess = '';
	private $objTouricoConfig = '';

	public function __construct($objProcess = NULL){
		if(is_array($objProcess)) {
			$this->objProcess = $objProcess[0];
		} elseif(is_object($objProcess)) {
			$this->objProcess = $objProcess;
		}
		$this->objWSClient = new WebServiceClient();
		$this->objTouricoConfig = $this->objProcess->TouricoConfig();
	}
	
	// Methods included in the Destinations WS
	public function GetDestination($Continent = null, $country = null){//'Africa'
		$postData = $this->objTouricoConfig->GetDestinationXml($Continent, $country);
		$arrayHeader = array (
				"SOAPAction" => "http://touricoholidays.com/WSDestinations/2008/08/Contracts/IDestinationContracts/GetDestination",
				"Content-type" => "text/xml",
				"Content-length" => strlen($postData) 
		);
		$arrayContinent = $this->objTouricoConfig->arrayContinent;
		$requestUrl = $this->objTouricoConfig->destinationsWSUrl;
		$this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl)->timeout(1728000)->gzip();
		$arrayResult = $this->objWSClient->DBCache(0)->execute_cUrl();
		return $this->parserXml($arrayResult);
	}

	public function GetHotelsByDestination($Continent, $country = null){
		$postData = $this->objTouricoConfig->GetHotelsByDestinationXml($Continent, $country);
		$arrayHeader = array (
				"SOAPAction" => "http://touricoholidays.com/WSDestinations/2008/08/Contracts/IDestinationContracts/GetHotelsByDestination",
				"Content-type" => "text/xml",
				"Content-length" => strlen($postData) 
		);
		$arrayContinent = $this->objTouricoConfig->arrayContinent;
		$requestUrl = $this->objTouricoConfig->destinationsWSUrl;
		
		$this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl)->timeout(1728000)->gzip();
		$arrayResult = $this->objWSClient->DBCache(0)->execute_cUrl('GetHotelsByDestination_'.$Continent.'_' . $country);
		//echo $arrayResult['result'];exit;
		return $this->parserXml($arrayResult);
	}

	public function GetActivitiesByDestination(){
	}

	public function GetHotelDetailsV3($arrayHotelIds) {
		return BaseBookTouricoService::instance($this->objProcess)->GetHotelDetailsV3($arrayHotelIds);
	}
	
}