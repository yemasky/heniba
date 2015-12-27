<?php
/**
 * file_name 2015年12月9日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
namespace merchant;

class TourismService extends \BaseService {
	public function getTourism($conditions, $fileid = NULL) {
        return \BaseTourismDao::instance()->DBCache(1800)->getTourism($conditions, $fileid);
    }

    public function getTourismCount($conditions) {
        return \BaseTourismDao::instance()->DBCache(1800)->getTourismCount($conditions);
    }
}