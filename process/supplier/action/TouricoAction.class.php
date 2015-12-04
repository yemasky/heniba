<?php
/**
 * file_name 2015年12月3日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
class TouricoAction extends BaseAction{

	protected function check($objRequest, $objResponse){
		$this->setDisplay();
	}

	protected function service($objRequest, $objResponse){
		switch($objRequest->getAction()){
			case 'config' :
				$this->getConfig($objRequest, $objResponse);
				break;
			case 'allproducts' :
				$this->getProducts($objRequest, $objResponse);
			default :
				$this->doBase($objRequest, $objResponse);
				break;
		}
	}

	/**
	 * 首页显示
	 */
	protected function doBase($objRequest, $objResponse){
		//$this->objProcess->TouricoService($this->objProcess)->GetDestination();
		//$this->objProcess->TouricoService($this->objProcess)->GetHotelsByDestination();
		//$this->objProcess->TouricoService($this->objProcess)->GetHotelDetailsV3();
		$this->objProcess->TouricoService($this->objProcess)->SearchHotelsById();
	}
}


