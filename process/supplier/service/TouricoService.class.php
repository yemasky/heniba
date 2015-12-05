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

	/*
	 * 1、Search
	 *
	 * Methods included in the Hotel V3 WS
	 */
	public function SearchHotels(){
	}

	public function SearchHotelsById(){
		$arrayHotelId = array (
				'1216326' 
		); // '1356675',
		$RoomsInformation = array (
				array (
						'AdultNum' => 2,
						'ChildNum' => 1,
						'ChildAge' => array (
								3 
						) 
				),
				array (
						'AdultNum' => 1,
						'ChildNum' => 0,
						'ChildAge' => array (
								0 
						) 
				) 
		);
		$arrayCheckData = array (
				'CheckIn' => '2015-12-24',
				'CheckOut' => '2015-12-30' 
		);
		$postData = $this->objTouricoConfig->SearchHotelsByIdXml($arrayHotelId, $RoomsInformation, $arrayCheckData);
		$arrayHeader = array (
				"SOAPAction" => $this->objTouricoConfig->SOAPActionSearchHotelsById,
				"Content-type" => "text/xml",
				"Content-length" => strlen($postData) 
		);
		$requestUrl = $this->objTouricoConfig->hotelV3WSUrl;
		
		$this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl);
		$arrayResult = $this->objWSClient->DBCache(0)->execute_cUrl();
		// $arrayResult['httpcode'] = 200;
		// $arrayResult['result'] = '<Rooms><Room seqNum="2"><AdultNum>1</AdultNum><ChildNum>0</ChildNum><ChildAges><ChildAge age="0"/></ChildAges></Room></Rooms>';
		return $this->parserXml($arrayResult);
	}

	public function SearchHotelsByDestinationIds(){
	}
	// end search
	//
	// 2、 More Info
	public function GetHotelDetailsV3($arrayHotelIds){
		//$arrayHotelIds = array ('1356675','1216326');
		$postData = $this->objTouricoConfig->GetHotelDetailsV3Xml($arrayHotelIds);
		$arrayHeader = array (
				"SOAPAction" => "http://tourico.com/webservices/hotelv3/IHotelFlow/GetHotelDetailsV3",
				"Content-type" => "text/xml",
				"Content-length" => strlen($postData) 
		);
		$requestUrl = $this->objTouricoConfig->hotelV3WSUrl;
		$this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl)->gzip();
		$arrayResult = $this->objWSClient->DBCache(0)->execute_cUrl($arrayHotelIds);
		//echo $arrayResult['result'];
		if($arrayResult['httpcode'] == 200) {
			preg_match('/<TWS_HotelDetailsV3([\s\S]+?)TWS_HotelDetailsV3>/', $arrayResult['result'], $arrayResultMatch);
			$arrayResult = '';
			$arrayResult['result'] = $arrayResultMatch[0];
			$arrayResult['httpcode'] = 200;
		} else {
			logError(json_encode($postData));
			logError(json_encode($arrayResult));
			return false;
		}
		return $this->parserXml($arrayResult);
	}
	// end More Info
	// 3、CLX Policy
	public function GetCancellationPolicies(){
		$arrayHotelInfo['hotelId'] = '1216326';
		$arrayHotelInfo['hotelRoomTypeId'] = '1975682';
		$arrayHotelInfo['dtCheckIn'] = '2016-08-09';
		$arrayHotelInfo['dtCheckOut'] = '2016-08-11';
		// Hotel V3 WS Flow
		$postData = $this->objTouricoConfig->GetCancellationPoliciesByHotelXml($arrayHotelInfo);
		$arrayHeader = array (
				"SOAPAction" => $this->objTouricoConfig->SOAPActionGetCancellationPolicies,
				"Content-type" => "text/xml",
				"Content-length" => strlen($postData) 
		);
		$requestUrl = $this->objTouricoConfig->hotelV3WSUrl;
		
		// 用于ReservationsService
		/*
		 * $postData = $this->objTouricoConfig->GetCancellationPoliciesXml(null, $arrayHotelInfo);
		 * $arrayHeader = array("SOAPAction" => $this->objTouricoConfig->SOAPActionGetCancellationPoliciesWS,
		 * "Content-type" => "text/xml", "Content-length" => strlen($postData));
		 * $requestUrl = $this->objTouricoConfig->ReservationsServiceUrl;
		 */
		
		$this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl);
		$arrayResult = $this->objWSClient->execute_cUrl();
		
		return $this->parserXml($arrayResult);
	}

	public function GetCancellationFee(){
	}

	public function CancelReservation(){
	}
	
	// 4、Verification
	public function CheckAvailabilityAndPrices(){
		$arrayHotelId = array (
				'1216326' 
		); // '1356675',
		$RoomsInformation = array (
				array (
						'AdultNum' => 2,
						'ChildNum' => 1,
						'ChildAge' => array (
								3 
						) 
				),
				array (
						'AdultNum' => 1,
						'ChildNum' => 0,
						'ChildAge' => array (
								0 
						) 
				) 
		);
		$arrayCheckData = array (
				'CheckIn' => '2015-12-24',
				'CheckOut' => '2015-12-30' 
		);
		$postData = $this->objTouricoConfig->CheckAvailabilityAndPricesXml($arrayHotelId, $RoomsInformation, $arrayCheckData);
		$arrayHeader = array (
				"SOAPAction" => $this->objTouricoConfig->SOAPActionCheckAvailabilityAndPrices,
				"Content-type" => "text/xml",
				"Content-length" => strlen($postData) 
		);
		$requestUrl = $this->objTouricoConfig->hotelV3WSUrl;
		
		$this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl);
		$arrayResult = $this->objWSClient->DBCache(0)->execute_cUrl();
		return $this->parserXml($arrayResult);
	}
	// end Verification
	
	//
	public function BookHotelV3(){
		$arrayHotelId = array (
				'1216326' 
		); // '1356675',
		$RoomsInformation = array (
				array (
						'AdultNum' => 2,
						'ChildNum' => 1,
						'ChildAge' => array (
								3 
						) 
				),
				array (
						'AdultNum' => 1,
						'ChildNum' => 0,
						'ChildAge' => array (
								0 
						) 
				) 
		);
		$arrayCheckData = array (
				'CheckIn' => '2015-12-24',
				'CheckOut' => '2015-12-30' 
		);
		$postData = $this->objTouricoConfig->CheckAvailabilityAndPricesXml($arrayHotelId, $RoomsInformation, $arrayCheckData);
		$arrayHeader = array (
				"SOAPAction" => $this->objTouricoConfig->SOAPActionCheckAvailabilityAndPrices,
				"Content-type" => "text/xml",
				"Content-length" => strlen($postData) 
		);
		$requestUrl = $this->objTouricoConfig->hotelV3WSUrl;
		
		$this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl);
		$arrayResult = $this->objWSClient->DBCache(0)->execute_cUrl();
		return $this->parserXml($arrayResult);
	}
	//
	public function CostAmend(){
	}

	public function DoAmend(){
	}

	public function GetPreviousReservations(){
	}

	public function GetRGInfo(){
	}

	public function GetPreviousRG(){
	}
	//
	public function parserXml($arrayResult) {
		if($arrayResult['httpcode'] == 200 && empty($arrayResult['error'])) {
			$objXML = new XML();
			$arrayXML = $objXML->parseToArray($arrayResult['result']);
			return $arrayXML;
		} else {
			throw new Exception(json_encode($arrayResult));
		}
	}
	
}