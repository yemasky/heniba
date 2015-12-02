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
	private $process_key = '';

	public function __construct($process_key = NULL){
		if(is_array($process_key)) {
			$this->process_key = $process_key[0];
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
			$objProcess = new Process($this->process_key);
			$objDao = $objProcess->BemyguestDao();
			if(isset($arrData['0'])) {
				foreach($arrData as $k => $v) {//print_r($v);
					foreach($v as $kk => $vv) {
						if(is_array($vv)) {
							$v[$kk] = json_encode($vv);
						}
						if(strpos($v[$kk], "'") !== false) {
							$v[$kk] = addslashes($vv);
						}
					}
					$id = $objDao::insertProduct($v);
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
				
				$id = $objDao::insertProduct($arrData);
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
}
