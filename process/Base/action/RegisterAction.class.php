<?php
/**
 *-------------------------
 *
 *
 * PHP versions 5

**/

class RegisterAction extends BaseAction {
	
	protected function check($objRequest, $objResponse) {
	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			case 'login':
				$this->doLogin($objRequest, $objResponse);
			break;
			case 'checklogin':
				$this->checkLogin($objRequest, $objResponse);
			break;
			case 'saveregister':
				$this->saveRegister($objRequest, $objResponse);
			break;
			case 'checkvalidate':
				$this->checkValidate($objRequest, $objResponse);
			break;
			case 'validate':
				$this->validateCode($objRequest, $objResponse);
			break;
			case 'logout':
				$this->doLogout($objRequest, $objResponse);
			break;
			default:
				$this->doRegister($objRequest, $objResponse);
			break;
		}
	}
	
	protected function doRegister($objRequest, $objResponse) {
		//设置tpl
		$objResponse -> setTplName("member/register");
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('index'));
	}
	
	protected function doLogin($objRequest, $objResponse) {
		//设置tpl
		$objResponse -> setTplName("member/login");
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('注册会员'));
	}
		
	protected function checkLogin($objRequest, $objResponse) {
		$validate = trim($objRequest->validate);
		$arrValue['email'] = trim($objRequest->email);
		$arrValue['password'] = trim($objRequest->password);
		$objCookie = new Cookie;
		$cookievalidate = $objCookie -> cookievalidate;
		if((getHis() - $objCookie -> cookietime) > 60*5) {
			alert('验证码超时，请重新登录！');
		}
		if($validate == "" || strtolower($validate) != strtolower($cookievalidate)) {
			alert('验证码错误，请重新登录！');
		} else {
			unset($objCookie -> cookievalidate);
		}
		$objRegisterDao = new RegisterDao;
		$objRegisterDao -> setTable('user_login');
		$arrValue['password'] = md5($arrValue['password']);
		$arrUserInfo = $objRegisterDao -> getRow($arrValue);
		if(empty($arrUserInfo)) alert('用户名或密码错误，请重新登录！');
		$objCookie -> loginuser = $arrUserInfo['id'] . '	' . $arrUserInfo['email'] . '	' . $arrUserInfo['username'];
		redirect('member.php');
	}
	
	protected function doLogout($objRequest, $objResponse) {
		$objCookie = new Cookie;
		unset($objCookie -> loginuser);
		$objCookie -> setCookie('loginuser', NULL, time() - 5000);
		redirect('./');
	}
		
	protected function saveRegister($objRequest, $objResponse) {
		$arrValue['nick_name'] = trim($objRequest->nick_name);
		if(empty($arrValue['nick_name'])) alert('称呼不能为空！');
		$arrValue['email'] = trim($objRequest ->email);
		if(empty($arrValue['email'])) alert('email不能为空！');
		$arrValue['password'] = trim($objRequest ->password);
		if(empty($arrValue['password'])) alert('密码不能为空！');
		$re_password = trim($objRequest ->re_password);
		if($arrValue['password'] != $re_password) alert('二次输入的密码不相同！');
		$validate = trim($objRequest ->validate);
		$objCookie = new Cookie;
		$cookievalidate = $objCookie -> cookievalidate;
		
		if((getHis() - $objCookie -> cookietime) > 60*5) {
			alert('验证码超时，请重新注册！');
		}
		if($validate == "" || strtolower($validate) != strtolower($cookievalidate)) {
			alert('验证码错误，请重新注册！');
		} else {
			unset($objCookie -> cookievalidate);
		}
		
		$objRegisterDao = new RegisterDao;
		$objRegisterDao -> setTable('user_login');
		if($objRegisterDao -> getCount(array('email'=>$arrValue['email'])) > 0) {
			alert('此email已经被注册，请重新注册！');
		}
		$arrValue['password'] = md5($arrValue['password']);
		$uid = $objRegisterDao -> insertData($arrValue);
		$objRegisterDao -> setTable('user_info');
		$objRegisterDao -> insertData(array('id'=>$uid, 'add_date'=>getDateTime()));
		//插入网站基本模块
		$objRegisterDao -> setTable('user_sites_channel');
		$arrsiteValue['uid'] = $uid;
		$arrsiteValue['channel'] = '首页';
		$arrsiteValue['channel_type'] = 'index';
		$arrsiteValue['channel_order'] = '0';
		$objRegisterDao -> insertData($arrsiteValue);
		//
		$arrsiteValue['channel'] = '产品展示';
		$arrsiteValue['channel_type'] = 'product';
		$arrsiteValue['channel_order'] = '1';
		$objRegisterDao -> insertData($arrsiteValue);
		//
		$arrsiteValue['channel'] = '新闻动态';
		$arrsiteValue['channel_type'] = 'news';
		$arrsiteValue['channel_order'] = '2';
		$fid = $objRegisterDao -> insertData($arrsiteValue);
		
		$arrsiteValue['fid'] = $fid;
		$arrsiteValue['channel'] = '行业动态';
		$arrsiteValue['channel_type'] = 'news';
		$arrsiteValue['channel_order'] = '3';
		$objRegisterDao -> insertData($arrsiteValue);
		$arrsiteValue['channel'] = '公司新闻';
		$fid = $arrsiteValue['channel_type'] = 'news';
		$arrsiteValue['channel_order'] = '4';
		$objRegisterDao -> insertData($arrsiteValue);
		unset($arrsiteValue['fid']);
		//
		$arrsiteValue['channel'] = '在线招聘';
		$arrsiteValue['channel_type'] = 'contents';
		$arrsiteValue['channel_order'] = '5';
		$objRegisterDao -> insertData($arrsiteValue);
		//
		$arrsiteValue['channel'] = '关于我们';
		$arrsiteValue['channel_type'] = 'contents';
		$arrsiteValue['channel_order'] = '6';
		$objRegisterDao -> insertData($arrsiteValue);
		//
		$arrsiteValue['channel'] = '在线留言';
		$arrsiteValue['channel_type'] = 'writes';
		$arrsiteValue['channel_order'] = '7';
		$objRegisterDao -> insertData($arrsiteValue);
		
		//插入corp
		$objRegisterDao -> setTable('user_corp');
		$objRegisterDao -> insertData(array('uid'=>$uid));
		//生成cache
		UserComm::getUserCache($uid, 'channel');
		//
		$objCookie -> loginuser = $uid . '	' . $arrValue['email'] . '	' . $arrValue['username'];
		redirect('member.php');
	}
	
	protected function checkValidate($objRequest, $objResponse) {
		$this -> setDisplay();
		$validate = trim($objRequest->validate);
		$objCookie = new Cookie;
		$cookievalidate = $objCookie -> cookievalidate;
		
		if((getHis() - $objCookie -> cookietime) > 60*5) {
			echo 1;
		}
		if($validate == "" || strtolower($validate) != strtolower($cookievalidate)) {
			echo 2;
		}
	}
	
	public function validateCode($objRequest, $objResponse) {
		$authnum = Valiimage::validateCode(4);
		$objCookie = new Cookie;
		$objCookie -> cookievalidate = $authnum;
		$time = getHis();
		$objCookie -> cookietime = $time;
		Valiimage::generateValidationImage($authnum, 80, 32);
		$this -> setDisplay();
	}


}
?>