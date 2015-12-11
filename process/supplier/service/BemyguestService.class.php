<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
class BemyguestService{
	private $objWSClient;
	private $arrayHeader = array (
			'X-Authorization' => BemyguestConfig::XAuthorization,
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
		$this->objWSClient->url(BemyguestConfig::config_url)->get()->header($this->arrayHeader);
		return $this->objWSClient->DBCache(0)->execute_file_get_contents();
	}

	public function allproducts($pn = 1){
		$url = BemyguestConfig::allproduct_url . $pn;
		$this->objWSClient->url($url)->get();
		$this->objWSClient->header($this->arrayHeader);
		return $this->objWSClient->DBCache(0)->execute_cUrl($url);
	}

	public function product($uuid){
		$url = BemyguestConfig::product_url . $uuid . "/?currency=CNY&language=ZH-HANS";
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

	public function resolveProductTypes($productTypes) {
		$arrayProductTypes = json_decode($productTypes, true);
		return $arrayProductTypes;
	}

	public function resolveProductTypesByUuid($uuid) {
		$conditions = DbConfig::$db_query_conditions;
		$conditions['condition']['uuid'] = $uuid;
		$arrayResult = BaseBemyguestDao::instance()->getBemyguestTour($conditions, 'productTypes');
		if(!empty($productTypes)) {
			return $this->resolveProductTypes($arrayResult[0]['productTypes']);
		}
	}

}
