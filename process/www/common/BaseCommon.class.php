<?php 
/*
	auther: cooc 
	email:yemasky@msn.com
*/

class BaseCommon {
	public static $arrIndustry = NULL;
	public function __construct() {		
	}
					
	public static function getMeta($index = 'index', $title = NULL, $description = NULL, $keywords = NULL, $content = NULL) {
		$arrMeta = NULL;
		include(__WWW_PATH . 'config/metaConfig.php');
		$arrMetaValue = $arrMeta['index'];
		if(isset($arrMeta[$index])) $arrMetaValue = $arrMeta[$index];
		$rs['Title'] = $title . $arrMetaValue['title'];
		$rs['Keywords'] = $keywords . $arrMetaValue['keywords'];
		$rs['Description'] = $description . $arrMetaValue['description'];
		$rs['Content'] = $content . $arrMetaValue['content'];
		return $rs;
	}
	
	public static function getLoginUser($objCookie = NULL, $isSession = false) {
		if(!is_object($objCookie) && $isSession == false){
			$objCookie = new Cookie;
		}
		if($isSession == false) {
			$loginuser = $objCookie -> loginuser;
		} else {
			$objSession = new Session();
			$loginuser = $objSession -> loginuser;
		}
		if(!empty($loginuser)) {
			$arrUser = explode('	', $loginuser);
			$arrUserInfo['uid'] = $arrUser[0];
			$arrUserInfo['email'] = $arrUser[1];
			$arrUserInfo['username'] = $arrUser[2];
			return $arrUserInfo;
		}
		return NULL;
	}
	
	public static function checkLoginUser($objCookie = NULL, $isSession = false) {
		if(!is_object($objCookie) && $isSession == false){
			$objCookie = new Cookie();
		}
		if($isSession == false) {
			$arrUserInfo = self::getLoginUser($objCookie);
		} else {
			$arrUserInfo = self::getLoginUser(NULL, true);
		}
		if(empty($arrUserInfo)) redirect(__WEB . 'login.php');
		return $arrUserInfo;
	}
		
}
?>