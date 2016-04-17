<?php
/**
 *-------------------------
 *
 * The show the detail of each product
 *
 * PHP versions 5

**/
namespace supplier;

class IndexAction extends \BaseAction {
	
	protected function check($objRequest, $objResponse) {

	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			case 'translatePlace':
				$this->translatePlace($objRequest, $objResponse);
				break;
			case 'translateTourism':
				$this->translateTourism($objRequest, $objResponse);
				break;
			case 'translateBemyguest':
				$this->translateBemyguest($objRequest, $objResponse);
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
		$objResponse -> setTplValue("__Meta", \BaseCommon::getMeta('index', '我的网站', '我的网站', '我的网站'));
		$objResponse -> setTplName("www/base");
	}

	protected function translatePlace($objRequest, $objResponse) {
		$this->setDisplay();
		$ojbTranslateTool = new TranslateTool();
		$ojbTranslateTool->translatePlace();

	}

	protected function translateTourism($objRequest, $objResponse) {
		$this->setDisplay();
		$ojbTranslateTool = new TranslateTool();
		$ojbTranslateTool->translateTourism();

	}

	protected function translateBemyguest($objRequest, $objResponse) {
		$this->setDisplay();
		$ojbTranslateTool = new TranslateTool();
		$ojbTranslateTool->translateBemyguest();

	}


	



}
?>