<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 16:56
 */
class MerchantUserService extends BaseService{

	public function getLoginUser($arrayLoginInfo){
		return $this->objProcess->MerchantUserDao()->getLoginUser($arrayLoginInfo);
	}
}