<?php
/**
 * file_name 2015年12月5日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
namespace supplier;

class TouricoTool extends \BaseTool {

	/*
	 * insertDestination
	 */
	public function insertDestination(){
		$objTouricoDao = new TouricoDao();
		$objTouricoService = new TouricoService();
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
			foreach($Continent['Country'] as $kk => $Country) {
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
				foreach($Country['State'][0]['City'] as $kkk => $City) {
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
						foreach($City['CityLocation'] as $kkkk => $CityLocation) {
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

	public function disposeHotels(){
		$objTouricoDao = new TouricoDao();
		$objTouricoService = new TouricoService();
		$arrayHotelIds = array ();
		$arrayHotels = array ();
		$arrayDestination = $objTouricoService->GetDestination();
		foreach($arrayDestination['s:Body'][0]['DestinationResponse'][0]['DestinationResult'][0]['Continent'] as $k => $Continent) {
			foreach($Continent['Country'] as $ck => $ContinentCountry) {
				$arrayHotelsByDestination = $objTouricoService->GetHotelsByDestination($Continent['name'], $ContinentCountry['name']);
				$ContinentHotel = $arrayHotelsByDestination['s:Body'][0]['HotelsByDestinationResponse'][0]['DestinationResult'][0]['Continent'];
				foreach($ContinentHotel as $kk => $Country) {
					foreach($Country['Country'][0]['State'][0]['City'] as $kkk => $City) {
						foreach($City['Hotels'][0]['Hotel'] as $kkkk => $hotels) {
							$arrayHotelIds[] = $hotels['hotelId'];
							if(count($arrayHotelIds) >= 10) {
								$arrayHotels = $objTouricoService->GetHotelDetailsV3($arrayHotelIds);
								if($arrayHotels == false) continue;
								$this->insertHotels($arrayHotels);
								$arrayHotelIds = array ();
							}
						}
						if(count($arrayHotelIds) > 0) {
							$arrayHotels = $objTouricoService->GetHotelDetailsV3($arrayHotelIds);
							if($arrayHotels == false) continue;
							$this->insertHotels($arrayHotels);
							$arrayHotelIds = array ();
						}
					}
				}
				echo "over ContinentCountry:" . $ContinentCountry['name'] . " \r\n";
				ob_flush();
				flush();
			}
			echo "over Continent:" . $Continent['name'] . " \r\n";
			ob_flush();
			flush();
		}
	}

	public function insertHotels($arrayHotels){
		$objTouricoDao = new TouricoDao();
		$arrayHotesData = array ();
		if(!isset($arrayHotels['Hotel']) || empty($arrayHotels['Hotel'])) {
			if(isset($arrayHotels['StatusCode'][0]['type'][0]) && $arrayHotels['StatusCode'][0]['type'][0] == 'Error') {
				logError(json_encode($arrayHotels));
				return;
			}
			throw new Exception(json_encode($arrayHotels));
		}
		foreach($arrayHotels['Hotel'] as $k => $hotel) {
			foreach($hotel as $kk => $value) {
				if(is_array($value))
					$hotel[$kk] = json_encode($value);
				$hotel[$kk] = addslashes($hotel[$kk]);
			}
			$hotel['Home'] = addslashes(json_encode($arrayHotels['Home'][$k]));
			$objTouricoDao->insertHotel($hotel);
			echo "over hotel:" . $hotel['hotelID'] . " \r\n";
			ob_flush();
			flush();
		}
	}

	public function insertCountryFromTouricoDestination() {
		$objTourismDao = new TourismDao();
		$arrarTouricoDestination = $objTourismDao->getTouricoDestination();
		$field = '(c_id, c_continent_id, c_country_id, c_city_id, c_name, c_latitude, c_longitude, c_type)';
		$sql = '';
		foreach($arrarTouricoDestination as $k => $v) {
			$sql .= "('".$v['c_id']."','".$v['c_continent_id']."','".$v['c_country_id']."','".$v['c_city_id']."','"
					.addslashes($v['c_name'])."','".$v['c_latitude']."','".$v['c_longitude']."','".$v['c_type']."'),";
			if(($k % 30) == 0) {
			$sql = "INSERT INTO country" . $field ." VALUES " . $sql;
				$objTourismDao->insertCountry(trim($sql, ','));
				$sql = '';
			}
		}
		if(!empty($sql)) {
			$sql = "INSERT INTO country" . $field ." VALUES " . $sql;
			$objTourismDao->insertCountry(trim($sql, ','));
		}
		echo "over.";
	}

	public function insertToHotelFromTourico($objRequest, $objResponse) {
		$pn = $objRequest->pn;
		$list_count = 1000;
		$conditions['limit'] = (($pn - 1) * $list_count) . ", $list_count";

		$objTouricoDao = new TouricoDao();

	}
}