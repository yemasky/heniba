<?php
/**
 * file_name 2015年12月3日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class TouricoService {
	private $objWSClient;
	private $process_key = '';
	
	public function __construct($process_key = NULL){
		if(is_array($process_key)) {
			$this->process_key = $process_key[0];
		}
		$this->objWSClient = new WebServiceClient();
	}
	
	//Methods included in the Destinations WS
	public function GetDestination() {
		
	}
	
	public function GetHotelsByDestination() {
		
	}
	
	public function GetActivitiesByDestination() {
		
	}
	
	//Methods included in the Hotel V3 WS
	public function SearchHotels() {
		
	}
	
	public function SearchHotelsById() {
		
	}
	
	public function SearchHotelsByDestinationIds() {
	
	}
	
	public function GetHotelDetailsV3() {
	
	}
	
	public function CheckAvailabilityAndPrices() {
	
	}
	
	public function BookHotelV3() {
	
	}
	
	public function CostAmend() {
	
	}
	
	public function DoAmend() {
	
	}
	
	public function GetRGInfo() {
	
	}
	
	
}