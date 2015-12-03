<?php

/**
 * file_name 2015年12月3日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015
 */
class TouricoService
{
    private $objWSClient;
    private $objProcess = '';
    private $objTouricoConfig = '';

    public function __construct($objProcess = NULL)
    {
        if (is_array($objProcess)) {
            $this->objProcess = $objProcess[0];
        }
        $this->objWSClient = new WebServiceClient();
        $this->objTouricoConfig = $this->objProcess->TouricoConfig();
    }

    //Methods included in the Destinations WS
    public function GetDestination()
    {
        $postData = $this->objTouricoConfig->GetDestinationXml('Africa');
        $arrayHeader = array("SOAPAction" => "http://touricoholidays.com/WSDestinations/2008/08/Contracts/IDestinationContracts/GetDestination",
            "Content-type" => "text/xml", "Content-length" => strlen($postData));
        $arrayContinent = $this->objTouricoConfig->arrayContinent;
        $requestUrl = $this->objTouricoConfig->destinationsWSUrl;
        $this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl);
        $arrayResult = $this->objWSClient->execute_cUrl();
        print_r($arrayResult);
    }

    public function GetHotelsByDestination()
    {
        $postData = $this->objTouricoConfig->GetHotelsByDestinationXml('Africa');
        $arrayHeader = array("SOAPAction" => "http://touricoholidays.com/WSDestinations/2008/08/Contracts/IDestinationContracts/GetHotelsByDestination",
            "Content-type" => "text/xml", "Content-length" => strlen($postData));
        $arrayContinent = $this->objTouricoConfig->arrayContinent;
        $requestUrl = $this->objTouricoConfig->destinationsWSUrl;

        $this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl);
        $arrayResult = $this->objWSClient->DBCache(0)->execute_cUrl();

        $objXML = new XML;
        $arrayXML = $objXML->parseToArray($arrayResult['result']);
        print_r($arrayXML);

    }

    public function GetActivitiesByDestination()
    {

    }

    //Methods included in the Hotel V3 WS
    public function SearchHotels()
    {

    }

    public function SearchHotelsById()
    {

    }

    public function SearchHotelsByDestinationIds()
    {

    }

    public function GetHotelDetailsV3()
    {
        $postData = $this->objTouricoConfig->GetHotelDetailsV3Xml(array('1356675','1216326'));
        $arrayHeader = array("SOAPAction" => "http://tourico.com/webservices/hotelv3/IHotelFlow/GetHotelDetailsV3",
            "Content-type" => "text/xml", "Content-length" => strlen($postData));
        $arrayContinent = $this->objTouricoConfig->arrayContinent;
        $requestUrl = $this->objTouricoConfig->hotelV3WSUrl;

        $this->objWSClient->ssl()->post($postData)->header($arrayHeader)->url($requestUrl);
        $arrayResult = $this->objWSClient->DBCache(0)->execute_cUrl();
        preg_match('/<TWS_HotelDetailsV3([\s\S]+?)TWS_HotelDetailsV3>/', $arrayResult['result'], $arrayResult);
        $objXML = new XML;
        $arrayXML = $objXML->parseToArray($arrayResult[0]);
        print_r($arrayXML);
    }

    public function CheckAvailabilityAndPrices()
    {

    }

    public function BookHotelV3()
    {

    }

    public function CostAmend()
    {

    }

    public function DoAmend()
    {

    }

    public function GetRGInfo()
    {

    }


}