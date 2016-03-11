<?php
/**
 * file_name 2015年12月9日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
namespace merchant;

class HotelService extends \BaseService {
	public function getHotel($conditions, $fileid = NULL, $m_id = null) {
        $arrayTourism = \BaseHotelDao::instance()->DBCache(1800)->getHotel($conditions, $fileid);
        if($m_id > 0) {
            $tourism_num = count($arrayTourism);
            for($i = 0; $i < $tourism_num; $i++) {
                $arrayRatePrice = CommonService::getMerchantRatePrice($m_id, $arrayTourism[$i]['t_price'], 'tourism');
                $arrayTourism[$i]['source'] = $arrayRatePrice['source'];
                $arrayTourism[$i]['sell'] = $arrayRatePrice['sell'];
            }
        }
        return $arrayTourism;
    }

    public function getHotelCount($conditions) {
        return \BaseHotelDao::instance()->DBCache(1800)->getHotelCount($conditions);
    }
}