<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 16:56
 */
namespace merchant;

class MerchantUserService extends \BaseService{

	public function getLoginUser($arrayLoginInfo){
		$objMerchantUserDao = new MerchantUserDao();
		return $objMerchantUserDao->getLoginUser($arrayLoginInfo);
	}
}