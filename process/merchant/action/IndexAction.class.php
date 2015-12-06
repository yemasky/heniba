<?php
/**
 * file_name 2015年12月6日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class IndexAction extends BaseAction {
	protected function check($objRequest, $objResponse) {
		if($objRequest->getAction() != 'login') {
			$this->objProcess->CommonService($this->objProcess)->checkLoginUser();
		}
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
		$arrayLoginInfo['mu_login_email'] = $objRequest->email;
		$arrayLoginInfo['mu_login_password'] = $objRequest->password;
		$remember_me = $objRequest->remember_me;
		$method = $objRequest->method;
		if($method == 'logout') {
			$this->objProcess->CommonService($this->objProcess)->logout();
			redirect(__WEB);
		}
		$error_login = 0;
		if(!empty($arrayLoginInfo['mu_login_email'] && !empty($arrayLoginInfo['mu_login_password']))) {
			$arrayUserInfo = $this->objProcess->MerchantUserService($this->objProcess)->checkLogin($arrayLoginInfo);
			if(!empty($arrayUserInfo)) {
				$arrayUserInfo[0]['mu_login_email'] = $arrayLoginInfo['mu_login_email'];
				$this->objProcess->CommonService($this->objProcess)->setLoginUserCookie($arrayUserInfo[0], $remember_me);
				redirect(__WEB);
			} else {
				$error_login = 1;
			}
		}
		$objResponse -> setTplValue('error_login', $error_login);
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
		$objResponse -> setTplName("merchant/admin_login");
	}

}