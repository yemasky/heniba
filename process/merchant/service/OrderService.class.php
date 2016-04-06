<?php
/**
 * file_name 2015年12月9日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
namespace merchant;

class OrderService extends \BaseService {
	public function getOrder($conditions, $fileid = NULL, $m_id = null) {
        $arrayhotel = \BaseOrderDao::instance()->getOrder($conditions, $fileid);
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

    public function getOrderCount($conditions) {
        return \BaseOrderDao::instance()->DBCache(1800)->getOrderCount($conditions);
    }

    public function searchOrder() {
        $arraySearchResult = NULL;

        return $arraySearchResult;

    }
}