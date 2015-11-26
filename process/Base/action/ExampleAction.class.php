<?php
/**
 *-------------------------
 *
 * The show the detail of each product
 *
 * PHP versions 5

**/

class ExampleAction extends BaseAction {
	
	protected function check($objRequest, $objResponse) {
	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			default:
				$this->doShowProduct($objRequest, $objResponse);
			break;
		}
	}

	/**
	 * 首页显示 
	 */
	protected function doShowProduct($objRequest, $objResponse) {
		$objCookie = new Cookie;
		$arrLoginUser = BaseComm::getLoginUser($objCookie);
		
		//设置值
		$objResponse -> test = 123456;
		//设置tpl
		$objResponse -> setTplName("www/index");

		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('伯乐网开发程序测试.com&trade;'));
	}

}
?>