<?php
class TouricoConfig {
	private $username = 'UBtour15';
	private $password = 'UBT@th2015';
	private $LoginName = 'bei104';
	private $LoginNamePassword = '111111';
	private $culture = 'en_US';
	private $version = '9';
	public $arrayContinent = array("Africa", "Asia/Far East", "Australia", "Caribbean",
			"Central America / Latin America", "Europe", "Middle East", "North America", "Pacific",
			"South America/Caribbean");
	public $destinationsWSUrl = 'http://destservices.touricoholidays.com/DestinationsService.svc?wsdl';
	public $hotelV3WSUrl = 'http://demo-hotelws.touricoholidays.com/HotelFlow.svc/bas';
	

	//searchHotels(SearchHotelsById, SearchHotelsByDestinationIds) -> GetHotelDetailsV3
	//->GetCancellationPolicies->CheckAvailabilityAndPrices->BookHotelV3->(CostAmend->DoAmend)
	//->CancelReservation(GetCancellationFee)
			
	protected function DestinationsWSHeader() {
		$header = '<soapenv:Header><dat:LoginHeader><dat:username>'.$this->username.'</dat:username>'
		         .'<dat:password>'.$this->password.'</dat:password>'
                 .'<dat:culture>'.$this->culture.'</dat:culture>'
                 .'<dat:version>'.$this->version.'</dat:version>'
				 .'</dat:LoginHeader></soapenv:Header>';
		return $header;
	}
	
	protected function HotelV3WSHeader() {
		$header = '<SOAP-ENV:Header><m:AuthenticationHeader xmlns:m="http://schemas.tourico.com/webservices/authentication">'
		         .'<m:LoginName>'.$this->LoginName.'</m:LoginName>'
		         .'<m:Password>'.$this->LoginNamePassword.'</m:Password>'
                 .'<m:Culture>'.$this->culture.'</m:Culture>'
                 .'<m:Version>'.$this->version.'</m:Version>'
				 .'</m:AuthenticationHeader></SOAP-ENV:Header>';
		return $header;
	}
	
	protected function HotelV3WSAutHeader() {
		$header = '<soapenv:Header><aut:AuthenticationHeader>'
		         .'<aut:LoginName>'.$this->LoginName.'</aut:LoginName>'
		         .'<aut:Password>'.$this->LoginNamePassword.'</aut:Password>'
                 .'<aut:Culture>'.$this->culture.'</aut:Culture>'
                 .'<aut:Version>'.$this->version.'</aut:Version>'
				 .'</aut:AuthenticationHeader></soapenv:Header>';
		return $header;
	}
	
	protected function ReservationWSHeader() {
		$header = '<soapenv:Header><web:LoginHeader>'
		         .'<trav:username>'.$this->LoginName.'</trav:username>'
		         .'<trav:password>'.$this->LoginNamePassword.'</trav:password>'
                 .'<trav:culture>'.$this->culture.'</trav:culture>'
                 .'<trav:version>'.$this->version.'</trav:version>'
				 .'</web:LoginHeader></soapenv:Header>';
		return $header;
	}
	
	public function GetDestinationXml($continent = null, $country = null, $state = null, $city = null, $statusDate = null) {
		if(!empty($statusDate)) {
			$statusDate = '<dat:StatusDate>'.$statusDate.'00:00:00</dat:StatusDate>';
		}
		$destinationsWSHeader = $this->DestinationsWSHeader();
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:dat="http://touricoholidays.com/WSDestinations/2008/08/DataContracts">'
		         .$destinationsWSHeader
		         .'<soapenv:Body><dat:GetDestination><dat:Destination>'
                 .'<dat:Continent>'.$continent.'</dat:Continent>'
                 .'<dat:Country>'.$country.'</dat:Country>'
				 .'<dat:State>'.$state.'</dat:State>'
				 .'<dat:City>'.$city.'</dat:City>'
				 .'<dat:Providers><dat:ProviderType>Default</dat:ProviderType></dat:Providers>'
				 .$statusDate
				 .'</dat:Destination></dat:GetDestination></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}
	
	public function GetHotelsByDestinationXml($continent = null, $country = null, $state = null, $city = null, $statusDate = null) {
		if(!empty($statusDate)) {
			$statusDate = '<dat:StatusDate>'.$statusDate.'00:00:00</dat:StatusDate>';
		}
		$destinationsWSHeader = $this->DestinationsWSHeader();
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:dat="http://touricoholidays.com/WSDestinations/2008/08/DataContracts">'
		         .$destinationsWSHeader
		         .'<soapenv:Body><dat:GetHotelsByDestination><dat:Destination>'
                 .'<dat:Continent>'.$continent.'</dat:Continent>'
                 .'<dat:Country>'.$country.'</dat:Country>'
				 .'<dat:State>'.$state.'</dat:State>'
				 .'<dat:City>'.$city.'</dat:City>'
				 .'<dat:Providers><dat:ProviderType>Default</dat:ProviderType></dat:Providers>'
				 .$statusDate
				 .'</dat:Destination></dat:GetHotelsByDestination></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}
	
	public function GetHotelDetailsV3Xml($arrayHotelId) {
		$strHotelid = '';
		foreach($arrayHotelId as $k => $v) {
			$strHotelid .= '<hot:HotelID id="'.$v.'"/>';
		}
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:aut="http://schemas.tourico.com/webservices/authentication" xmlns:hot="http://tourico.com/webservices/hotelv3">'
		         .$this->HotelV3WSAutHeader()
		         .'<soapenv:Body><hot:GetHotelDetailsV3><hot:HotelIds>'
                 .$strHotelid
				 .'</hot:HotelIds></hot:GetHotelDetailsV3></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}
	
	public function GetCancellationPoliciesXml($nResID) {
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://tourico.com/webservices/" xmlns:trav="http://tourico.com/travelservices/">'
		         .$this->ReservationWSHeader()
		         .'<soapenv:Body><web:GetCancellationPolicies>'
                 .'<web:nResID>'.nResID.'</web:nResID>'
				 .'</web:GetCancellationPolicies></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}
	
	//δ���
	public function CheckAvailabilityAndPricesXml($arrayHotelId, $checkIn, $checkOut) {
		$strHotelid = '';
		foreach($arrayHotelId as $k => $v) {
			$strHotelid .= '<hot:HotelID id="'.$v.'"/>';
		}
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:aut="http://schemas.tourico.com/webservices/authentication" xmlns:hot="http://tourico.com/webservices/hotelv3" xmlns:hot1="http://schemas.tourico.com/webservices/hotelv3">'
		         .$this->HotelV3WSAutHeader()
		         .'<soapenv:Body><hot:CheckAvailabilityAndPrices><hot:request>'
                 .'<hot1:HotelIdsInfo>'.$strHotelid.'</hot1:HotelIdsInfo>'
				 .'<hot1:CheckIn>'.$checkIn.'</hot1:CheckIn><hot1:CheckOut>'.$checkOut.'</hot1:CheckOut>'
				 .'<hot1:RoomsInformation><hot1:RoomInfo>'
				 .'</hot1:RoomInfo></hot1:RoomsInformation>'
				 .'<hot1:AdultNum>2</hot1:AdultNum>'
				 .'<hot1:ChildNum>0</hot1:ChildNum>'
				 .'<hot1:ChildAges>
                     <hot1:ChildAge age="0"/>
                  </hot1:ChildAges>'
				 .'<hot1:MaxPrice>0</hot1:MaxPrice><hot1:StarLevel>0</hot1:StarLevel><hot1:AvailableOnly>true</hot1:AvailableOnly>'
				 .'</hot:request><hot:CheckAvailabilityAndPrices></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}
	
	public function BookHotelV3Xml() {
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:aut="http://schemas.tourico.com/webservices/authentication" xmlns:hot="http://tourico.com/webservices/hotelv3" xmlns:hot1="http://schemas.tourico.com/webservices/hotelv3">'
		         .$this->HotelV3WSAutHeader()
		         .'<soapenv:Body><hot:BookHotelV3><hot:request>'
                 .$this->BookHotelV3RequestXml()
				 .'</hot:request><hot:BookHotelV3></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}
	
	public function BookHotelV3RequestXml() {
		$xml = '<hot1:RecordLocatorId>0</hot1:RecordLocatorId>'
		      .'<hot1:HotelId>1203719</hot1:HotelId>'
			  .'<hot1:HotelRoomTypeId>1699316</hot1:HotelRoomTypeId>'
			  .'<hot1:CheckIn>2013-11-15</hot1:CheckIn>'
			  .'<hot1:CheckOut>2013-11-20</hot1:CheckOut>'
			  .'<hot1:RoomsInfo>';
	}
	
	
	

}