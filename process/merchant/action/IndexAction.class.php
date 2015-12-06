<?php
/**
 * file_name 2015年12月6日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class IndexAction extends BaseAction {
	protected function check($objRequest, $objResponse) {
	
	}
	
	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			case 'admin_header':
				$this->admin_header($objRequest, $objResponse);
				break;
			case 'login':
				$this->admin_login($objRequest, $objResponse);
				break;
			case 'logout':
				$this->admin_logout($objRequest, $objResponse);
				break;
			case 'register':
				$this->admin_register($objRequest, $objResponse);
				break;
			default:
				$this->doBase($objRequest, $objResponse);
				break;
		}
	}
	
	/**
	 * 首页显示
	 */
	protected function doBase($objRequest, $objResponse) {
		//赋值
		//设置类别
		$objResponse -> nav = 'index';
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
		$objResponse -> setTplName("merchant/base");
	}

	protected function admin_header($objRequest, $objResponse) {
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
		$objResponse -> setTplName("merchant/inc/admin_header");
	}

	protected function admin_login($objRequest, $objResponse) {
		$this->objProcess->CommonService($this->objProcess)->getLoginMerchantUser();
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
		$objResponse -> setTplName("merchant/admin_login");
	}

}