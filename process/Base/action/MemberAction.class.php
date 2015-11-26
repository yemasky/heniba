<?php
/**
 *-------------------------
 *
 *
 * PHP versions 5

**/

class MemberAction extends BaseAction {
	
	public function check($objRequest, $objResponse) {
		$objCookie = new Cookie;
		$arrLoginUser = BaseComm::checkLoginUser($objCookie);
		$objResponse -> arrLoginUser = $arrLoginUser;
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta($arrLoginUser['username'] . '的会员中心'));
	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			case 'top':
				$this->doShowMemberTop($objRequest, $objResponse);
			break;
			case 'menu':
				$this->doShowMemberMenu($objRequest, $objResponse);
			break;
			case 'welcome':
				$this->doShowMemberWelcome($objRequest, $objResponse);
			break;
			case 'myreginfo':
				$this->doShowmyReginfo($objRequest, $objResponse);
			break;
			case 'myinfo':
				$this->doShowMyinfo($objRequest, $objResponse);
			break;
			default:
				$this->doShowMemberPage($objRequest, $objResponse);
			break;
		}
	}

	/**
	 * 首页显示 
	 */
	protected function doShowMemberPage($objRequest, $objResponse) {
		//设置tpl
		$objResponse -> setTplName("member/main");
	}
	
	protected function doShowMemberTop($objRequest, $objResponse) {
		//设置tpl
		$objResponse -> setTplName("member/top");
	}
	
	protected function doShowMemberMenu($objRequest, $objResponse) {
		//设置tpl
		$objResponse -> setTplName("member/menu");
	}
	
	protected function doShowMemberWelcome($objRequest, $objResponse) {
		$objResponse -> now = (date("H") + 0);
		//设置tpl
		$objResponse -> setTplName("member/welcome");
	}
	
	protected function doShowmyReginfo($objRequest, $objResponse) {
		$act = $objRequest -> act;
		$arrLoginUser = $objResponse -> arrLoginUser;
		$objRegisterDao = new RegisterDao;
		$objRegisterDao -> setTable('user_login');
		if($act == 'save') {
			$arrUpdate['username'] = trim($objRequest -> username);
			$password = trim($objRequest -> password);
			$re_password = trim($objRequest -> re_password);
			if(empty($password)) alert('修改资料请把您的当前密码填上！'); 
			$arrUserInfo = $objRegisterDao -> getRow(array('password'=>md5($password), 'email'=>$arrLoginUser['email']));
			if(empty($arrUserInfo)) alert('修改失败，您的密码不正确！'); 
			if(!empty($re_password)) $arrUpdate['password'] = md5($re_password);
			$objRegisterDao -> update(array('password'=>md5($password), 'email'=>$arrLoginUser['email']), $arrUpdate);
			$objCookie = new Cookie;
			$objCookie -> loginuser = $arrUserInfo['id'] . '	' . $arrUserInfo['email'] . '	' . $arrUpdate['username'];
			alert('更新资料成功！', 0);
			redirect('member.php?action=myreginfo');
		}
		$arrUserInfo = $objRegisterDao -> getRow(array('id'=>$arrLoginUser['uid']));
		
		//设置值
		$objResponse -> arrUserInfo = $arrUserInfo;
		//设置tpl
		$objResponse -> setTplName("member/myreginfo");
	}
	
	protected function doShowMyinfo($objRequest, $objResponse) {
		$act = $objRequest -> act;
		$arrLoginUser = $objResponse -> arrLoginUser;
		if($act == 'save') {
			$arrUpdate['sex'] = trim($objRequest -> sex);
			$arrUpdate['birthday'] = trim($objRequest -> birthday);
			$arrUpdate['birthday'] = empty($arrUpdate['birthday']) ? '1980-00-00' : $arrUpdate['birthday'];
			$arrUpdate['qq'] = trim($objRequest -> qq);
			$arrUpdate['msn'] = trim($objRequest -> msn);
			$arrUpdate['wangwang'] = trim($objRequest -> wangwang);
			$arrUpdate['phone'] = trim($objRequest -> phone);
			
			$objMemberDao = new MemberDao;
			$objMemberDao -> update(array('id'=>$arrLoginUser['uid']), $arrUpdate);
			//更新用户缓存
			UserComm::cacheUserData($arrLoginUser['uid'], $arrUpdate);
			alert('更新资料成功！', 0);
			redirect('member.php?action=myinfo');
		}
		//$arrUserInfo = $objMemberDao -> getUserInfo(array('id'=>$arrLoginUser['uid']));
		$arrUserInfo = UserComm::getUserCache($arrLoginUser['uid'], 'info');
		
		//设置值
		$objResponse -> arrUserInfo = $arrUserInfo;
		//设置tpl
		$objResponse -> setTplName("member/myinfo");
	}
}
?>