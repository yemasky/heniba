<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
namespace supplier;
class BemyguestService{
	private $objWSClient;
	private $arrayHeader = '';
	private $DataBemyssguest;
	private $objProcess = '';
	private $time_out = 1800;
	private $objBemyguestConfig = "";

	public function __construct(){
		$this->objWSClient = new \WebServiceClient();
		$this->objBemyguestConfig = new BemyguestConfig();

		$this->arrayHeader = $this->objBemyguestConfig->arrayHeader;
	}

	public function config(){
		set_time_limit(0);
		$this->objWSClient->url($this->objBemyguestConfig->config_url)->get()->header($this->arrayHeader);
		return $this->objWSClient->DBCache(0)->execute_file_get_contents();
	}

	public function allproducts($pn = 1){
		$url = $this->objBemyguestConfig->allproduct_url . $pn;
		$this->objWSClient->url($url)->get();
		$this->objWSClient->header($this->arrayHeader);
		return $this->objWSClient->DBCache(0)->execute_cUrl($url);
	}

	public function product($uuid, $arrayDate = null, $cacheTime = 0){
		//$uuid = '50a55f6c-3deb-50a2-a7d0-7ca404c9494f';
		$url = $this->objBemyguestConfig->product_url . $uuid . "/?currency=CNY&language=ZH-HANS";
		if(!empty($arrayDate)) {
			$url .= '&date_start=' . $arrayDate['date_start'] . '&date_end=' . $arrayDate['date_end'];
		}
		$this->objWSClient->url($url)->get();
		$this->objWSClient->header($this->arrayHeader);
		if($cacheTime >= 0) {
			return $this->objWSClient->DBCache($cacheTime)->execute_cUrl($uuid);
		} else {
			return $this->objWSClient->execute_cUrl($uuid);
		}
	}

	public function checkSaveProduct($arrData, $updateCondition = NULL){
		if(!empty($arrData)) {
			$objBemyguestDao = new BemyguestDao();
			if(isset($arrData['0'])) {
				foreach($arrData as $k => $v) { // print_r($v);
					foreach($v as $kk => $vv) {
						if(is_array($vv)) {
							$v[$kk] = json_encode($vv);
						}
						//if(strpos($v[$kk], "'") !== false) {
						if($v[$kk] != '') {
							$v[$kk] = addslashes($vv);
						}
						if($kk == 'paxMin' && empty($v[$kk])) {
							$v[$kk] = $v['productTypes'][0]['paxMin'];
						}
						if($kk == 'paxMax' && empty($v[$kk])) {
							$v[$kk] = $v['productTypes'][0]['paxMax'];
						}
						//}
					}
					if(empty($updateCondition)) {
						$id = $objBemyguestDao->insertProduct($v);
					} else {
						$objBemyguestDao->updateBemyguestTour($updateCondition, $v);
					}
					if(!empty($id)) {
						echo "add :" . $v['uuid'] . ', id:' . $id . "\r\n";
					} elseif(empty($updateCondition)) {
						echo "continue code :" . $v['uuid'] . "\r\n";
					} else {
						echo "re save code :" . $v['uuid'] . "\r\n";
					}
					ob_flush();
					flush();
				}
			} else {
				foreach($arrData as $k => $v) {
					if(is_array($v)) {
						$arrData[$k] = json_encode($v);
					}
					//if(strpos($arrData[$k], "'") !== false) {
					if($arrData[$k] != '') {
						$arrData[$k] = addslashes($arrData[$k]);
					}
					if($k == 'paxMin' && empty($arrData[$k])) {
						$arrData[$k] = $arrData['productTypes'][0]['paxMin'];
					}
					if($k == 'paxMax' && empty($arrData[$k])) {
						$arrData[$k] = $arrData['productTypes'][0]['paxMax'];
					}

					//}
				}
				if(empty($updateCondition)) {
					$id = $objBemyguestDao->insertProduct($arrData);
				} else {
					$objBemyguestDao->updateBemyguestTour($updateCondition, $arrData);
				}
				if(!empty($id)) {
					echo "add :" . $arrData['uuid'] . ', id:' . $id . "\r\n";
				} elseif(empty($updateCondition)) {
					echo "continue code :" . $arrData['uuid'] . "\r\n";
				} else {
					echo "re save code :" . $arrData['uuid'] . "\r\n";
				}
				ob_flush();
				flush();
				//print_r($arrData);exit();
			}
		}
	}

	public function resolveProductTypes($productTypes) {
		$arrayProductTypes = json_decode($productTypes, true);
		return $arrayProductTypes;
	}

	public function resolveProductTypesByUuid($uuid) {
		$conditions = \DbConfig::$db_query_conditions;
		$conditions['condition']['uuid'] = $uuid;
		$objBemyguestDao = new BemyguestDao();
		$arrayResult = $objBemyguestDao->getBemyguestTour($conditions, 'productTypes');
		if(!empty($productTypes)) {
			return $this->resolveProductTypes($arrayResult[0]['productTypes']);
		}
	}

}
