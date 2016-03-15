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
		$pn = $objRequest->pn > 0 ? $objRequest->pn : 1;
		$list_count = 10;
		$conditions = \DbConfig::$db_query_conditions;
		$conditions['limit'] = (($pn - 1) * $list_count) . ", $list_count";
		$conditions['where'] = '';
		$objTouricoDao = new TouricoDao();
		$arrayTouricoHotel = $objTouricoDao->getTouricoHotel($conditions);
		if(empty($arrayTouricoHotel)) {
			exit('over!');
		}
		//brand
		$conditions = \DbConfig::$db_query_conditions;
		$num = count($arrayTouricoHotel);
		for($i = 0; $i < $num; $i++) {
			//brand
			$arrayTouricoHotel[$i]['brand'] = trim($arrayTouricoHotel[$i]['brand']);
			$conditions['where'] = array('hb_name'=>$arrayTouricoHotel[$i]['brand']);
			$arrayBrand = \BaseHotelDao::instance()->getHotelBrand($conditions);
			if(empty($arrayBrand) && !empty($arrayTouricoHotel[$i]['brand'])) {
				$arrayBrandData['hb_name'] = $arrayTouricoHotel[$i]['brand'];
				$arrayBrand[0]['hb_id']  = \BaseHotelDao::instance()->insertHotelBrand($arrayBrandData);
			}
			if(isset($arrayBrand[0]['hb_id']) && $arrayBrand[0]['hb_id'] > 0)
				$arrayHotel['hb_id'] = $arrayBrand[0]['hb_id'];
			//c_country_id
			$arrayLocation = json_decode($arrayTouricoHotel[$i]['Location'], true);
			$conditions['where'] = array('c_name'=>$arrayLocation[0]['country']);
			$arrayCountry = \BaseHotelDao::instance()->getCountry($conditions);
			if(empty($arrayCountry)) {
				throw new \Exception('$arrayCountry country is null');
			}
			$arrayHotel['c_country_id'] = $arrayCountry[0]['c_id'];
			//c_city_id
			$conditions['where'] = array('c_name'=>$arrayLocation[0]['city']);
			$arrayCountry = \BaseHotelDao::instance()->getCountry($conditions);
			if(empty($arrayCountry)) {
				throw new \Exception('$arrayCountry city is null');
			}
			$arrayHotel['c_city_id'] = $arrayCountry[0]['c_id'];
			//h_rooms
			$arrayHotel['h_rooms'] = $arrayTouricoHotel[$i]['rooms'];
			//h_check_in h_check_out
			$arrayHotel['h_check_in'] = $arrayTouricoHotel[$i]['checkInTime'];
			$arrayHotel['h_check_out'] = $arrayTouricoHotel[$i]['checkOutTime'];
			$arrayHotel['h_currency'] = $arrayTouricoHotel[$i]['currency'];
			$arrayHotel['h_images'] = $arrayTouricoHotel[$i]['thumb'];
			$arrayHotel['h_phone'] = $arrayTouricoHotel[$i]['hotelPhone'];
			$arrayHotel['h_fax'] = $arrayTouricoHotel[$i]['hotelFax'];
			$arrayHotel['h_address'] = addslashes($arrayLocation[0]['address']);
			$arrayHotel['h_zip'] = $arrayLocation[0]['zip'];
			$arrayHotel['h_start_level'] = $arrayTouricoHotel[$i]['starLevel'];
			$arrayHotel['h_rank'] = $arrayTouricoHotel[$i]['ranking'];
			$arrayHotel['h_latitude'] = $arrayLocation[0]['latitude'];
			$arrayHotel['h_longitude'] = $arrayLocation[0]['longitude'];
			//PropertyType
			$arrayPropertyType = json_decode($arrayTouricoHotel[$i]['Home'], true);
			$arrayHotel['h_hotel_type'] = $arrayPropertyType['PropertyType'][0];
			$arrayHotel['h_add_date'] = getDateTime();
			$arrayHotel['h_supplier'] = 'tourico';
			$arrayHotel['h_supplier_code'] = $arrayTouricoHotel[$i]['hotelID'];
			$arrayDescription = json_decode($arrayTouricoHotel[$i]['Descriptions'], true);
			if(isset($arrayDescription[0]['FreeTextShortDescription'][0]['desc'])) {
				$arrayHotel['h_description'] = addslashes($arrayDescription[0]['FreeTextShortDescription'][0]['desc']);
			}
			$arrayHotel['h_name'] = addslashes($arrayTouricoHotel[$i]['name']);
			$h_id = \BaseHotelDao::instance()->insertHotel($arrayHotel);

			$arrayAttributeValue = json_decode($arrayTouricoHotel[$i]['Amenities'], true);
			$conditions['where'] = array('ha_name'=>'Amenityes');
			$arrayAttribute = \BaseHotelDao::instance()->getAttribute($conditions);
			if(empty($arrayAttribute)) {
				$ha_id = \BaseHotelDao::instance()->insertAttribute(array('ha_name'=>'Amenityes'));
			} else {
				$ha_id = $arrayAttribute[0]['ha_id'];
			}
			//insert hotel_attribute_value
			$attr_num = count($arrayAttributeValue[0]['Amenity']);
			$arrayAttributeData['h_id'] = $h_id;
			$arrayAttributeData['ha_id'] = $ha_id;
			//echo $attr_num;
			//print_r($arrayAttributeValue[0]['Amenity']);
			for($j = 0; $j < $attr_num; $j++) {
				$arrayAttributeData['hav_value'] = addslashes($arrayAttributeValue[0]['Amenity'][$j]['name']);
				//echo $arrayAttributeData['hav_value'] . "<br>\r\n";
				\BaseHotelDao::instance()->insertAttributeValue($arrayAttributeData);
			}


		}

		/*print_r($arrayTouricoHotel);
		print_r(json_decode($arrayTouricoHotel[0]['RoomType'], true));
		print_r(json_decode($arrayTouricoHotel[0]['Location'], true));
		print_r(json_decode($arrayTouricoHotel[0]['RefPoints'], true));
		print_r(json_decode($arrayTouricoHotel[0]['Descriptions'], true));
		print_r(json_decode($arrayTouricoHotel[0]['Media'], true));
		print_r(json_decode($arrayTouricoHotel[0]['Amenities'], true));
		print_r(json_decode($arrayTouricoHotel[0]['Home'], true));*/
	}
}