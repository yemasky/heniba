<?php
namespace supplier;

class TouricoConfig {
	private $username = 'UBtour15';
	private $password = 'UBT@th2015';
	private $LoginName = 'bei104';
	private $LoginNamePassword = '111111';
	private $culture = 'zh_CN';
	private $version = '9';
	public $arrayContinent = array("Africa", "Asia/Far East", "Australia", "Caribbean",
			"Central America / Latin America", "Europe", "Middle East", "North America", "Pacific",
			"South America/Caribbean");
	public $destinationsWSUrl = 'http://destservices.touricoholidays.com/DestinationsService.svc?wsdl';
	public $hotelV3WSUrl = 'http://demo-hotelws.touricoholidays.com/HotelFlow.svc/bas';
	public $ReservationsServiceUrl = 'http://demo-wsnew.touricoholidays.com/ReservationsService.asmx'; //ReservationsService

	public $SOAPActionGetDestination = 'http://touricoholidays.com/WSDestinations/2008/08/Contracts/IDestinationContracts/GetDestination';
	public $SOAPActionGetHotelsByDestination = 'http://touricoholidays.com/WSDestinations/2008/08/Contracts/IDestinationContracts/GetHotelsByDestination';

	public $SOAPActionSearchHotels = 'http://tourico.com/webservices/hotelv3/IHotelFlow/SearchHotels';
	public $SOAPActionSearchHotelsById = 'http://tourico.com/webservices/hotelv3/IHotelFlow/SearchHotelsById';
	public $SOAPActionGetHotelDetailsV3 = 'http://tourico.com/webservices/hotelv3/IHotelFlow/GetHotelDetailsV3';
	public $SOAPActionGetCancellationPolicies = 'http://tourico.com/webservices/hotelv3/IHotelFlow/GetCancellationPolicies';
	public $SOAPActionCheckAvailabilityAndPrices = 'http://tourico.com/webservices/hotelv3/IHotelFlow/CheckAvailabilityAndPrices';

	public $SOAPActionBookHotelV3 = 'http://tourico.com/webservices/hotelv3/IHotelFlow/BookHotelV3';

	public $SOAPActionGetCancellationPoliciesWS = 'http://tourico.com/webservices/GetCancellationPolicies'; //ReservationsService

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

	protected function ReservationSoapHeader() {
		$header = '<soap:Header><web:LoginHeader>'
			.'<trav:username>'.$this->LoginName.'</trav:username>'
			.'<trav:password>'.$this->LoginNamePassword.'</trav:password>'
			.'<trav:culture>'.$this->culture.'</trav:culture>'
			.'<trav:version>'.$this->version.'</trav:version>'
			.'</web:LoginHeader></soap:Header>';
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
	
	public function GetCancellationPoliciesByHotelXml($arrayHotelInfo = null) {
		$strnResID = '';
		if(!empty($arrayHotelInfo)) {
			$strnResID = ' <hot:hotelId>'.$arrayHotelInfo['hotelId'].'</hot:hotelId><hot:hotelRoomTypeId>'.$arrayHotelInfo['hotelRoomTypeId'].'</hot:hotelRoomTypeId>'
				        .'<hot:dtCheckIn>'.$arrayHotelInfo['dtCheckIn'].'</hot:dtCheckIn><hot:dtCheckOut>'.$arrayHotelInfo['dtCheckOut'].'</hot:dtCheckOut>'
				        .'<hot:productId></hot:productId>';
		}
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:aut="http://schemas.tourico.com/webservices/authentication" xmlns:hot="http://tourico.com/webservices/hotelv3">'
		         .$this->HotelV3WSAutHeader()
		         .'<soapenv:Body><hot:GetCancellationPolicies>'
                 .$strnResID
				 .'</hot:GetCancellationPolicies></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}

	public function GetCancellationPoliciesXml($nResID = null, $arrayHotelInfo = null) {//ReservationsService
		$strnResID = '';
		if(!empty($strnResID)) $strnResID = '<web:nResID>'.nResID.'</web:nResID>';
		if(!empty($arrayHotelInfo)) {
			$strnResID = ' <web:hotelId>'.$arrayHotelInfo['hotelId'].'</web:hotelId><web:hotelRoomTypeId>'.$arrayHotelInfo['hotelRoomTypeId'].'</web:hotelRoomTypeId>'
				.'<web:dtCheckIn>'.$arrayHotelInfo['dtCheckIn'].'</web:dtCheckIn><web:dtCheckOut>'.$arrayHotelInfo['dtCheckOut'].'</web:dtCheckOut>'
				.'<web:productId></web:productId>';
		}
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://tourico.com/webservices/" xmlns:trav="http://tourico.com/travelservices/">'
			.$this->ReservationWSHeader()
			.'<soapenv:Body><web:GetCancellationPolicies>'
			.$strnResID
			.'</web:GetCancellationPolicies></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}
	
	//
	public function CheckAvailabilityAndPricesXml($arrayHotelId, $RoomsInformation, $arrayCheckData) {
		$strHotelid = '';
		foreach($arrayHotelId as $k => $v) {
			$strHotelid .= '<hot1:HotelIdInfo id="'.$v.'"/>';
		}

		$strRoomsInformation = '';
		foreach($RoomsInformation as $k => $v) {
			$strChildAge = '';
			foreach ($v['ChildAge'] as $CAk => $CAv) {
				$strChildAge .= '<hot1:ChildAge age="' . $CAv . '"/>';
			}
			$strRoomsInformation .= '<hot1:RoomInfo><hot1:AdultNum>'.$v['AdultNum'].'</hot1:AdultNum>'
				.'<hot1:ChildNum>'.$v['ChildNum'].'</hot1:ChildNum>'
				.'<hot1:ChildAges>'.$strChildAge.'</hot1:ChildAges></hot1:RoomInfo>';
		}

		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:aut="http://schemas.tourico.com/webservices/authentication" xmlns:hot="http://tourico.com/webservices/hotelv3" xmlns:hot1="http://schemas.tourico.com/webservices/hotelv3">'
		         .$this->HotelV3WSAutHeader()
		         .'<soapenv:Body><hot:CheckAvailabilityAndPrices><hot:request>'
                 .'<hot1:HotelIdsInfo>'.$strHotelid.'</hot1:HotelIdsInfo>'
				 .'<hot1:CheckIn>'.$arrayCheckData['CheckIn'].'</hot1:CheckIn><hot1:CheckOut>'.$arrayCheckData['CheckOut'].'</hot1:CheckOut>'
				 .'<hot1:RoomsInformation>'
				 .$strRoomsInformation
				 .'</hot1:RoomsInformation>'
				 .'<hot1:MaxPrice>0</hot1:MaxPrice><hot1:StarLevel>0</hot1:StarLevel><hot1:AvailableOnly>true</hot1:AvailableOnly>'
				 .'</hot:request></hot:CheckAvailabilityAndPrices></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}
	
	public function BookHotelV3Xml() {
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:aut="http://schemas.tourico.com/webservices/authentication" xmlns:hot="http://tourico.com/webservices/hotelv3" xmlns:hot1="http://schemas.tourico.com/webservices/hotelv3">'
		         .$this->HotelV3WSAutHeader()
		         .'<soapenv:Body><hot:BookHotelV3><hot:request>'
                 .$this->BookHotelV3requestXml()
				 .'</hot:request><hot:BookHotelV3></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}
	
	public function BookHotelV3requestXml($arrayBookInfo) {
		$strRoomInfo = '';
		foreach($arrayBookInfo['RoomsInfo'] as $k => $v) {
			$strChildAge = '';
			foreach($v['ChildAge'] as $CAk => $VAv) {
				$strChildAge .= '<hot1:ChildAge age="'.$VAv.'"/>';
			}
			$strRoomInfo .='<hot1:RoomReserveInfo><hot1:RoomId>'.$k.'</hot1:RoomId>'
				         .'<hot1:ContactPassenger><hot1:FirstName>'.$v['FirstName'].'</hot1:FirstName>'
						 .'<hot1:MiddleName>'.$v['FirstName'].'</hot1:MiddleName>'
				         .'<hot1:MiddleName>'.$v['MiddleName'].'</hot1:MiddleName>'
						 .'<hot1:LastName>'.$v['LastName'].'</hot1:LastName>'
						 .'<hot1:HomePhone>'.$v['HomePhone'].'</hot1:HomePhone>'
						 .'<hot1:MobilePhone>'.$v['MobilePhone'].'</hot1:MobilePhone>'
						 .'<hot1:SelectedBoardBase><hot1:Id>'.$v['Id'].'</hot1:Id><hot1:Price>'.$v['Price'].'</hot1:Price></hot1:SelectedBoardBase>'
						 .'<hot1:SelectedSupplements><hot1:SupplementInfo suppId="'.$v['suppId'].'" supTotalPrice="'.$v['supTotalPrice'].'" suppType="'.$v['suppType'].'">'
						 .'<hot1:SupAgeGroup><hot1:SuppAges suppFrom="'.$v['suppFrom'].'" suppTo="'.$v['suppTo'].'" suppQuantity="'.$v['suppQuantity'].'" suppPrice="'.$v['suppPrice'].'"/></hot1:SupAgeGroup></hot1:SupplementInfo></hot1:SelectedSupplements>'
						 .'<hot1:Bedding>'.$v['Bedding'].'</hot1:Bedding>'
						 .'<hot1:Note>'.$v['Note'].'</hot1:Note>'
						 .'<hot1:AdultNum>'.$v['AdultNum'].'</hot1:AdultNum><hot1:ChildNum>'.$v['ChildNum'].'</hot1:ChildNum>'
						 .'<hot1:ChildAges>'.$strChildAge.'</hot1:ChildAges></hot1:RoomReserveInfo>';
		}
		$xml = '<hot1:RecordLocatorId>'.$arrayBookInfo['RecordLocatorId'].'</hot1:RecordLocatorId>'
		      .'<hot1:HotelId>'.$arrayBookInfo['HotelId'].'</hot1:HotelId>'
			  .'<hot1:HotelRoomTypeId>'.$arrayBookInfo['HotelRoomTypeId'].'</hot1:HotelRoomTypeId>'
			  .'<hot1:CheckIn>'.$arrayBookInfo['CheckIn'].'</hot1:CheckIn>'
			  .'<hot1:CheckOut>'.$arrayBookInfo['CheckOut'].'</hot1:CheckOut>'
			  .'<hot1:RoomsInfo>'.$strRoomInfo.'</hot1:RoomsInfo>'
			  .'<hot1:PaymentType>'.$arrayBookInfo['PaymentType'].'</hot1:PaymentType>'
			  .'<hot1:AgentRefNumber>'.$arrayBookInfo['AgentRefNumber'].'</hot1:AgentRefNumber>'
			  .'<hot1:ContactInfo>'.$arrayBookInfo['ContactInfo'].'</hot1:ContactInfo>'
			  .'<hot1:RequestedPrice>'.$arrayBookInfo['RequestedPrice'].'</hot1:RequestedPrice><hot1:DeltaPrice>'.$arrayBookInfo['DeltaPrice'].'</hot1:DeltaPrice>'
			  .'<hot1:Currency>'.$arrayBookInfo['Currency'].'</hot1:Currency>'
			  .'<hot1:DeltaPrice>'.$arrayBookInfo['DeltaPrice'].'</hot1:DeltaPrice><hot1:Currency>'.$arrayBookInfo['Currency'].'</hot1:Currency>'
			  .'<hot1:ConfirmationEmail>'.$arrayBookInfo['ConfirmationEmail'].'</hot1:ConfirmationEmail>'
			  .'<hot1:ConfirmationLogo/>'.$arrayBookInfo['ConfirmationLogo'].'</hot1:ConfirmationLogo>'
			  .'</hot:request></hot:BookHotelV3></soapenv:Body></soapenv:Envelope>';

		;
	}

	public function SearchHotelsByIdXml($arrayHotelId, $RoomsInformation, $arrayCheckData) {
		$xml = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:m0="http://schemas.tourico.com/webservices/hotelv3">'
			.$this->HotelV3WSHeader()
			.'<SOAP-ENV:Body><m:SearchHotelsById xmlns:m="http://tourico.com/webservices/hotelv3"><m:request>'
			.$this->SearchHotelsByIdrequestXml($arrayHotelId, $RoomsInformation, $arrayCheckData)
			.'</m:request></m:SearchHotelsById></SOAP-ENV:Body></SOAP-ENV:Envelope>';
		return $xml;
	}

	/*
	 * parameter $arrayHotelId  RoomsInformation
	 */
	public function SearchHotelsByIdrequestXml($arrayHotelId, $RoomsInformation, $arrayCheckData) {
		$strHotelid = '';
		foreach($arrayHotelId as $k => $v) {
			$strHotelid .= '<m0:HotelIdInfo id="'.$v.'"/>';
		}

		$strRoomsInformation = '';
		foreach($RoomsInformation as $k => $v) {
			$strChildAge = '';
			foreach ($v['ChildAge'] as $CAk => $CAv) {
				$strChildAge .= '<m0:ChildAge age="' . $CAv . '"/>';
			}
			$strRoomsInformation .= '<m0:RoomInfo><m0:AdultNum>'.$v['AdultNum'].'</m0:AdultNum>'
				.'<m0:ChildNum>'.$v['ChildNum'].'</m0:ChildNum>'
				.'<m0:ChildAges>'.$strChildAge.'</m0:ChildAges></m0:RoomInfo>';
		}

		$xml = '<m0:HotelIdsInfo>'
			  .$strHotelid
			  .'</m0:HotelIdsInfo>'
			  .'<m0:CheckIn>'.$arrayCheckData['CheckIn'].'</m0:CheckIn><m0:CheckOut>'.$arrayCheckData['CheckOut'].'</m0:CheckOut><m0:RoomsInformation>'
			  .$strRoomsInformation
			  .'</m0:RoomsInformation><m0:MaxPrice>0</m0:MaxPrice><m0:StarLevel>0</m0:StarLevel><m0:AvailableOnly>true</m0:AvailableOnly>';
		return $xml;
	}

	public function SearchHotelsRequestXml($arraySearchInformation, $arrayCheckData, $arrayRoomsInformation) {
		$strRoomsInformation = '';
		foreach($arrayRoomsInformation as $k => $v) {
			$strChildAge = '';
			foreach ($v['ChildAge'] as $CAk => $CAv) {
				$strChildAge .= '<hot1:ChildAge age="'.$CAv.'"/>';//'<m0:ChildAge age="' . $CAv . '"/>';
			}
			$strRoomsInformation .= '<hot1:RoomInfo><hot1:AdultNum>'.$v['AdultNum'].'</hot1:AdultNum>'
				.'<hot1:ChildNum>'.$v['ChildNum'].'</hot1:ChildNum>'
				.'<hot1:ChildAges>'.$strChildAge.'</hot1:ChildAges></hot1:RoomInfo>';
		}

		$xml =   '<hot1:Destination>'.$arraySearchInformation['Destination'].'</hot1:Destination>'
				.'<hot1:HotelCityName>'.$arraySearchInformation['HotelCityName'].'</hot1:HotelCityName>'
				.'<hot1:HotelLocationName>'.$arraySearchInformation['HotelLocationName'].'</hot1:HotelLocationName>'
				.'<hot1:HotelName>'.$arraySearchInformation['HotelName'].'</hot1:HotelName>'
				.'<hot1:CheckIn>'.$arrayCheckData['CheckIn'].'</hot1:CheckIn>'
				.'<hot1:CheckOut>'.$arrayCheckData['CheckOut'].'</hot1:CheckOut>'
				.'<hot1:RoomsInformation>'. $strRoomsInformation .'</hot1:RoomsInformation>'
				.'<hot1:MaxPrice>0</hot1:MaxPrice>'
				.'<hot1:StarLevel>0</hot1:StarLevel>'
				.'<hot1:AvailableOnly>true</hot1:AvailableOnly>'
				.'<hot1:PropertyType>NotSet</hot1:PropertyType>'
				.'<hot1:ExactDestination>true</hot1:ExactDestination>';
		return $xml;
	}

	public function SearchHotelsXml($arraySearchInformation, $arrayCheckData, $arrayRoomsInformation) {
		$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:aut="http://schemas.tourico.com/webservices/authentication" xmlns:hot="http://tourico.com/webservices/hotelv3" xmlns:hot1="http://schemas.tourico.com/webservices/hotelv3">'
			.$this->HotelV3WSAutHeader()
			.'<soapenv:Body><hot:SearchHotels><hot:request>'
			.$this->SearchHotelsRequestXml($arraySearchInformation, $arrayCheckData, $arrayRoomsInformation)
			.'</hot:request></hot:SearchHotels></soapenv:Body></soapenv:Envelope>';
		return $xml;
	}


	
	
	

}