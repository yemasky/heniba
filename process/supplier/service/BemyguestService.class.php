<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
class BemyguestService{
	private $objWSClient;
	private $url = 'https://api.bemyguest.com.sg/v1/config';
	private $arrayHeader = array (
			'X-Authorization' => '0396f6d91697994390d7f47f0bf41b37cb2f96f0',
			'Content-Type' => 'application/json' 
	);
	private $DataBemyssguest;
	private $objProcess = '';
	private $time_out = 1800;

	public function __construct($objProcess = NULL){
		if(is_array($objProcess)) {
			$this->objProcess = $objProcess[0];
		} elseif(is_object($objProcess)) {
			$this->objProcess = $objProcess;
		}
		$this->objWSClient = new WebServiceClient();
	}

	public function config(){
		set_time_limit(0);
		$this->objWSClient->url($this->url)->get()->header($this->arrayHeader);
		return $this->objWSClient->DBCache(-1)->execute_file_get_contents();
	}

	public function allproducts($pn = 1){
		$url = "https://api.bemyguest.com.sg/v1/products?language=en&currency=CNY&per_page=100&page=" . $pn;
		$this->objWSClient->url($url)->get();
		$this->objWSClient->header($this->arrayHeader);
		return $this->objWSClient->DBCache(0)->execute_cUrl($url);
	}

	public function product($uuid){
		$url = "https://api.bemyguest.com.sg/v1/products/$uuid/?currency=CNY&language=ZH-HANS";
		$this->objWSClient->url($url)->get();
		$this->objWSClient->header($this->arrayHeader);
		return $this->objWSClient->DBCache(0)->execute_cUrl($uuid);
	}

	public function checkSaveProduct($arrData){
		if(!empty($arrData)) {
			$objDao = $this->objProcess->BemyguestDao();
			if(isset($arrData['0'])) {
				foreach($arrData as $k => $v) { // print_r($v);
					foreach($v as $kk => $vv) {
						if(is_array($vv)) {
							$v[$kk] = json_encode($vv);
						}
						if(strpos($v[$kk], "'") !== false) {
							$v[$kk] = addslashes($vv);
						}
					}
					$id = $objDao->insertProduct($v);
					if(!empty($id)) {
						echo "add :" . $v['uuid'] . ', id:' . $id . "\r\n";
					} else {
						echo "continue code :" . $v['uuid'] . "\r\n";
					}
					ob_flush();
					flush();
				}
			} else {
				foreach($arrData as $k => $v) {
					if(is_array($v)) {
						$arrData[$k] = json_encode($v);
					}
					if(strpos($arrData[$k], "'") !== false) {
						$arrData[$k] = addslashes($arrData[$k]);
					}
				}
				
				$id = $objDao->insertProduct($arrData);
				if(!empty($id)) {
					echo "add :" . $arrData['uuid'] . ', id:' . $id . "\r\n";
				} else {
					echo "continue code :" . $arrData['uuid'] . "\r\n";
				}
				ob_flush();
				flush();
			}
		}
	}

	public function createbooking($productTypeUuid, $timeSlotUuid, $addonsuuid){
		set_time_limit($this->time_out);
		$arrData['salutation'] = "Mr.";
		$arrData['firstName'] = 'firstName';
		$arrData['lastName'] = 'lastName';
		$arrData['email'] = 'kefu@yelove.cn';
		$arrData['phone'] = '+6591591923';
		$arrData['message'] = 'message';
		$arrData['productTypeUuid'] = $productTypeUuid;
		$arrData['pax'] = '2';
		$arrData['children'] = '0';
		if(!empty($timeSlotUuid)) {
			$arrData['timeSlotUuid'] = $timeSlotUuid;
		} else {
			// $arrData['timeSlotUuid'] = "";
		}
		if(!empty($addonsuuid)) {
			$arrData['addons'][0]['uuid'] = $addonsuuid;
			$arrData['addons'][0]['quantity'] = '1';
		} else {
			// $arrData['addons'] = "";
		}
		$arrData['arrivalDate'] = '2015-12-07';
		$arrData['partnerReference'] = time() . "";
		$arrData['usePromotion'] = false;
		$postData = json_encode($arrData);
		
		// $url = "https://private-anon-de10e2970-bemyguest.apiary-mock.com/v1/bookings";
		$url = "https://apidemo.bemyguest.com.sg/v1/bookings";
		
		$header = "POST: HTTP/1.1\r\n";
		$header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
		$header .= "Content-Type: application/json\r\n";
		$header .= "Content-Length: " . strlen($postData) . "\r\n";
		
		echo $arrData['partnerReference'] . ":" . $url . "\r\n";
		
		$opts = array (
				'http' => array (
						'method' => "POST",
						'header' => $header,
						'content' => $postData 
				) 
		);
		
		$context = stream_context_create($opts);
		$string = file_get_contents($url, "r", $context);
		print_r($http_response_header);
		var_dump($string);
		print_r($postData);
		$string = json_decode($string, true);
		$createbookuuid = $string['data']['uuid'];
		$param = "productTypeUuid/$productTypeUuid/timeSlotUuid/$timeSlotUuid/addonsuuid/$addonsuuid/partnerReference/" . $arrData['partnerReference'] . "/createbookuuid/" . $createbookuuid;
		$url = __ROOT__ . "/index.php/Viator/BemyguestDemo/checkbooking/" . $param;
		
		echo "\r\n<br>click  <a href='$url'>here</a> checkbooking.\r\n<br>";
	}

	public function checkbooking($productTypeUuid, $timeSlotUuid, $addonsuuid, $partnerReference, $createbookuuid){
		ini_set('memory_limit', '5120M');
		set_time_limit(0);
		
		$arrData['salutation'] = "Mr.";
		$arrData['firstName'] = 'firstName';
		$arrData['lastName'] = 'lastName';
		$arrData['email'] = 'kefu@yelove.cn';
		$arrData['phone'] = '+6591591923';
		$arrData['message'] = 'message';
		$arrData['productTypeUuid'] = $productTypeUuid;
		$arrData['pax'] = '2';
		$arrData['children'] = '0';
		if(!empty($timeSlotUuid)) {
			$arrData['timeSlotUuid'] = $timeSlotUuid;
		} else {
			// $arrData['timeSlotUuid'] = "";
		}
		if(!empty($addonsuuid)) {
			$arrData['addons'][0]['uuid'] = $addonsuuid;
			$arrData['addons'][0]['quantity'] = '1';
		} else {
			// $arrData['addons'] = "";
		}
		$arrData['arrivalDate'] = '2015-12-07';
		$arrData['partnerReference'] = time() . "";
		$arrData['usePromotion'] = false;
		$postData = json_encode($arrData);
		
		// $url = "https://private-anon-de10e2970-bemyguest.apiary-mock.com/v1/bookings/check";
		$url = "https://apidemo.bemyguest.com.sg/v1/bookings/check";
		$header = "POST: HTTP/1.1\r\n";
		$header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
		$header .= "Content-Type: application/json\r\n";
		$header .= "Content-Length: " . strlen($postData) . "\r\n";
		
		echo $arrData['partnerReference'] . ":" . $url . "\r\n";
		
		$opts = array (
				'http' => array (
						'method' => "POST",
						'header' => $header,
						'content' => $postData 
				) 
		);
		
		$context = stream_context_create($opts);
		$string = file_get_contents($url, "r", $context);
		print_r($http_response_header);
		var_dump($string);
		print_r($postData);
		$returnString = json_decode($string, true);
		
		$uuid = $createbookuuid;
		$param = "uuid/" . $uuid;
		$url = __ROOT__ . "/index.php/Viator/BemyguestDemo/getkbookingstatus/" . $param;
		
		echo "\r\n<br>click  <a href='$url'>here</a> getkbookingstatus.\r\n<br>";
	}

	public function getkbookingstatus($uuid){
		set_time_limit(0); //
		$string = '';
		
		// $url = "https://apidemo.bemyguest.com.sg/v1/bookings/uuid";
		$url = "https://apidemo.bemyguest.com.sg/v1/bookings/" . $uuid;
		$header = "GET: HTTP/1.1\r\n";
		$header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
		echo $url . "\r\n";
		$opts = array (
				'http' => array (
						'method' => "GET",
						'header' => $header 
				) 
		);
		
		$context = stream_context_create($opts);
		$string = file_get_contents($url, 'r', $context);
		
		$string = json_decode($string, true);
		print_r($string);
		print_r($http_response_header);
		$param = "uuid/" . $uuid . "/status/";
		$url1 = __ROOT__ . "/index.php/Viator/BemyguestDemo/updatekbookingstatus/" . $param . "confirm";
		$url2 = __ROOT__ . "/index.php/Viator/BemyguestDemo/updatekbookingstatus/" . $param . "cancel";
		;
		
		echo "\r\n<br>click  <a href='$url1'>confirm the booking</a> \r\n<br>";
		echo "\r\n<br>click  <a href='$url2'>cancel the booking</a> \r\n<br>";
	}

	public function updatekbookingstatus($uuid, $status){
		set_time_limit(0); //
		$string = '';
		
		// $url = "https://private-anon-de10e2970-bemyguest.apiary-mock.com/v1/bookings/uuid/status";
		$url = "https://apidemo.bemyguest.com.sg/v1/bookings/" . $uuid . "/" . $status;
		$header = "PUT: HTTP/1.1\r\n";
		$header .= "Content-Type: application/json\r\n";
		$header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
		echo $url . "\r\n";
		$opts = array (
				'http' => array (
						'method' => "PUT",
						'header' => $header 
				) 
		);
		
		$context = stream_context_create($opts);
		$string = file_get_contents($url, 'r', $context);
		
		var_dump($string);
		print_r($http_response_header);
		
		/*
		 * $string = file_put_contents($url, 'r', $context);
		 *
		 * $string = json_decode($string, true);
		 * var_dump($string);
		 * print_r($http_response_header);
		 *
		 * return $string;
		 */
	}
}
