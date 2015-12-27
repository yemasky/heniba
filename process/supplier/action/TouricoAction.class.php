<?php
/**
 * file_name 2015年12月3日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
namespace supplier;

class TouricoAction extends \BaseAction{

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
			case 'parserdestination' :
				$this->parserDestination($objRequest, $objResponse);
				break;
			case 'disposehotels' :
				$this->disposeHotels($objRequest, $objResponse);
				break;
			case 'insertcountry' :
				$this->insertCountry($objRequest, $objResponse);
				break;
			default :
				$this->doBase($objRequest, $objResponse);
				break;
		}
	}

	/**
	 * 首页显示
	 */
	protected function doBase($objRequest, $objResponse){
		$objTouricoService = new TouricoService();
		//$result = $this->objProcess->TouricoService($this->objProcess)->GetDestination('Asia/Far East', 'China');
		$result = $objTouricoService->GetHotelsByDestination('Africa');
		//$result = $this->objProcess->TouricoService($this->objProcess)->GetHotelDetailsV3();
		//$this->objProcess->TouricoService($this->objProcess)->SearchHotelsById();
		//$this->objProcess->TouricoService($this->objProcess)->GetCancellationPolicies();
		//$this->objProcess->TouricoService($this->objProcess)->CheckAvailabilityAndPrices();
		print_r($result);
		echo json_encode($result);
	}
	
	protected function parserDestination($objRequest, $objResponse) {
		$objTouricoTool = new TouricoTool();
		//$this->objProcess->TouricoService($this->objProcess)->insertDestination();
		$objTouricoTool->insertDestination();
	}
	
	protected function disposeHotels($objRequest, $objResponse) {
		$objTouricoTool = new TouricoTool();
		//$this->objProcess->TouricoService($this->objProcess)->insertDestination();
		$objTouricoTool->disposeHotels();
	}

	protected function insertCountry($objRequest, $objResponse) {
		$objTouricoTool = new TouricoTool();
		$objTouricoTool->insertCountryFromTouricoDestination();
	}
}


