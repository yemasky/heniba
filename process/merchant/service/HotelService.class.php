<?php
/**
 * file_name 2015年12月9日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
namespace merchant;

use supplier\TouricoDao;

class HotelService extends \BaseService {
	public function getHotel($conditions, $fileid = NULL, $m_id = null) {
        $arrayhotel = \BaseHotelDao::instance()->getHotel($conditions, $fileid);
        if($m_id > 0) {
            $hotel_num = count($arrayhotel);
            for($i = 0; $i < $hotel_num; $i++) {
                $arrayRatePrice = CommonService::getMerchantRatePrice($m_id, $arrayhotel[$i]['h_price'], 'hotel');
                $arrayhotel[$i]['wholesale'] = $arrayRatePrice['wholesale'];
                $arrayhotel[$i]['sell'] = $arrayRatePrice['sell'];
            }
        }
        return $arrayhotel;
    }

    public function getHotelCount($conditions) {
        return \BaseHotelDao::instance()->DBCache(1800)->getHotelCount($conditions);
    }

    public function searchHotel($supplier_code, $arraySearchData) {
        $arraySearchResult = NULL;
        switch ($supplier_code) {
            case 'tourico':
                $objTouricoDao = new TouricoDao();
                $conditions = \DbConfig::$db_query_conditions;
                $conditions['where'] = "`name` = '".$arraySearchData['place_en_name']."'";
                $fileid = 'destinationCode';
                $arrayDestinationCode = $objTouricoDao->getDestination($conditions, $fileid);
                if(empty($arrayDestinationCode)) {
                    return false;
                }
                $arraySearchData['HotelCityName'] = $arraySearchData['HotelLocationName'] = $arraySearchData['HotelName'] = null;

                if($arraySearchData['place_type'] == 'CityLocation') {
                    $arraySearchData['HotelLocationName'] = $arraySearchData['place_en_name'];
                } else {
                    $arraySearchData['HotelCityName'] = $arraySearchData['place_en_name'];
                }
                $arraySearchData['Destination'] = $arrayDestinationCode[0]['destinationCode'];
                $arraySearchResult = \BaseSupplierTouricoService::instance()->DBCache(1800)->SearchHotels($arraySearchData);
                break;
            default:
                break;
        }
        return $arraySearchResult;

    }
}