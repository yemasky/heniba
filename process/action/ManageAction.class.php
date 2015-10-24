<?php
/**
 *-------------------------
 *
 *
 * PHP versions 5

**/

class ManageAction extends BaseAction {
	
	protected function check($objRequest, $objResponse) {
		$action = $objRequest->getAction();
		if($action != 'checklogin' && $action != 'login') {
			$arrManageUser = BaseComm::checkLoginUser(NULL, true);
			$objResponse -> arrManageUser = $arrManageUser;
		}
	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			case 'login':
				$this->doLogin($objRequest, $objResponse);
			break;
			case 'checklogin':
				$this->checkLogin($objRequest, $objResponse);
			break;
			case 'logout':
				$this->doLogout($objRequest, $objResponse);
			break;
			case 'top':
				$this->showTop($objRequest, $objResponse);
			break;
			case 'menu':
				$this->showMenu($objRequest, $objResponse);
			break;
			case 'welcome':
				$this->showWelcome($objRequest, $objResponse);
			break;
			default:
				$this->showManage($objRequest, $objResponse);
			break;
		}
	}
		
	protected function doLogin($objRequest, $objResponse) {
		$objResponse -> setTplName("manage/login");
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('manage_login'));
	}
		
	protected function checkLogin($objRequest, $objResponse) {
		$validate = trim($objRequest->validate);
		$arrValue['email'] = trim($objRequest->email);
		$arrValue['password'] = trim($objRequest->password);
		$objCookie = new Cookie;
		$cookievalidate = $objCookie -> cookievalidate;
		if((getHis() - $objCookie -> cookietime) > 60*50) {
			alert('验证码超时，请重新登录！');
		}
		if($validate == "" || strtolower($validate) != strtolower($cookievalidate)) {
			alert('验证码错误，请重新登录！');
		} else {
			unset($objCookie -> cookievalidate);
		}
		$objManageDao = new ManageDao;
		$objManageDao -> setTable('manage_user_login');
		$arrValue['password'] = md5($arrValue['password']);
		//$arrUserInfo = $objManageDao -> getRow($arrValue);
		//if(empty($arrUserInfo)) alert('用户名或密码错误，请重新登录！');
		$objSession = new Session();
		//$objSession -> loginuser = $arrUserInfo['id'] . '	' . $arrUserInfo['email'] . '	' . $arrUserInfo['username'];
		redirect('manage.html');
	}
	
	protected function doLogout($objRequest, $objResponse) {
		$objSession = new Cookie;
		unset($objSession -> loginuser);
		//$objCookie -> setCookie('loginuser', NULL, time() - 5000);
		redirect('./');
	}
	
	protected function showManage($objRequest, $objResponse) {
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('manage'));
		$objResponse -> setTplName("manage/main");
	}
	
	protected function showTop($objRequest, $objResponse) {
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('manage'));
		$objResponse -> setTplName("manage/top");
	}
	
	protected function showMenu($objRequest, $objResponse) {
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('manage'));
		$objResponse -> setTplName("manage/menu");
	}
	
	protected function showWelcome($objRequest, $objResponse) {
		$objResponse -> now = (date("H") + 0);
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('manage'));
		$objResponse -> setTplName("manage/welcome");
	}
		
}
?>