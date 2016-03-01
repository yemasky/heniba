<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 16:56
 */
namespace merchant;

class MerchantService extends \BaseService{

	public function getMerchant($conditions, $fileid = NULL){
		$objMerchantDao = new MerchantDao();
		return $objMerchantDao->getMerchant($conditions, $fileid);
	}
}