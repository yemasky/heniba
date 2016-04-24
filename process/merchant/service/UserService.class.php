<?php
/**
 * file_name 2015年12月9日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
namespace merchant;

class UserService extends \BaseService {
	public function getOrderInfoUserList($conditions, $fileid = NULL) {
        $arrayResult = \BaseOrderDao::instance()->getOrder($conditions, $fileid);
        return $arrayResult;
    }

    public function getOrderInfoUserCount($conditions) {
        return \BaseOrderDao::instance()->getOrderCount($conditions);
    }


}