<?php
/**
 * file_name 2015年12月5日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class TouricoTool {
	private $objProcess = '';
	
	public function __construct($objProcess = NULL){
		if(is_array($objProcess)) {
			$this->objProcess = $objProcess[0];
		} elseif(is_object($objProcess)) {
			$this->objProcess = $objProcess;
		}
	}
	
	/*
	 * insertDestination
	 */
	public function insertDestination() {
		$objTouricoDao = $this->objProcess->TouricoDao();
		$objTouricoService = $this->objProcess->TouricoService($this->objProcess);
		$arrayDestination = $objTouricoService->GetDestination();
		foreach($arrayDestination['s:Body'][0]['DestinationResponse'][0]['DestinationResult'][0]['Continent'] as $k => $Continent) {
			$arrayData['name'] = $Continent['name'];
			$arrayData['elementType'] = $Continent['elementType'];
			$arrayData['destinationId'] = $Continent['destinationId'];
			$arrayData['provider'] = $Continent['provider'];
			$arrayData['status'] = $Continent['status'];
			$arrayData['destination_type'] = 'Continent';
			$Continent_id = $objTouricoDao->insertDestination($arrayData);
			$arrayData = null;
			foreach ($Continent['Country'] as $kk => $Country) {
				$arrayData['Continent_id'] = $Continent_id;
				$arrayData['name'] = addslashes($Country['name']);
				$arrayData['elementType'] = $Country['elementType'];
				$arrayData['destinationId'] = $Country['destinationId'];
				$arrayData['provider'] = $Country['provider'];
				$arrayData['status'] = $Country['status'];
				$arrayData['destination_type'] = 'Country';
				$Country_id = $objTouricoDao->insertDestination($arrayData);
				$arrayData = null;
				echo "over Country_id:$Country_id \r\n";
				ob_flush();
				flush();
				foreach ($Country['State'][0]['City'] as $kkk => $City) {
					$arrayData['Continent_id'] = $Continent_id;
					$arrayData['Country_id'] = $Country_id;
					$arrayData['name'] = addslashes($City['name']);
					$arrayData['elementType'] = $City['elementType'];
					$arrayData['destinationId'] = $City['destinationId'];
					$arrayData['provider'] = $City['provider'];
					$arrayData['status'] = $City['status'];
					$arrayData['destinationCode'] = $City['destinationCode'];
					$arrayData['cityLatitude'] = $City['cityLatitude'];
					$arrayData['cityLongitude'] = $City['cityLongitude'];
					$arrayData['destination_type'] = 'City';
					$City_id = $objTouricoDao->insertDestination($arrayData);
					echo "over City_id:$City_id \r\n";
					ob_flush();
					flush();
					$arrayData = null;
					if(isset($City['CityLocation'])) {
						foreach ($City['CityLocation'] as $kkkk => $CityLocation) {
							$arrayData['Continent_id'] = $Continent_id;
							$arrayData['Country_id'] = $Country_id;
							$arrayData['City_id'] = $City_id;
							$arrayData['name'] = addslashes($CityLocation['location']);
							$arrayData['elementType'] = $CityLocation['elementType'];
							$arrayData['destinationId'] = $CityLocation['destinationId'];
							$arrayData['provider'] = $CityLocation['provider'];
							$arrayData['status'] = $CityLocation['status'];
							$arrayData['location'] = addslashes($CityLocation['location']);
							$arrayData['destinationCode'] = $CityLocation['destinationCode'];
							$arrayData['destination_type'] = 'CityLocation';
							$CityLocationid = $objTouricoDao->insertDestination($arrayData);
							$arrayData = null;
							echo "over CityLocationid:$CityLocationid \r\n";
							ob_flush();
							flush();
						}
					}
				}
			}
		}
	}

	public function insertHotel() {
		
	}
}