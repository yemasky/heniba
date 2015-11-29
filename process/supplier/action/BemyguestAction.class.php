<?php
/**
 *-------------------------
 *
 * The show the detail of each product
 *
 * PHP versions 5

**/


class BemyguestAction extends BaseAction {
	protected function check($objRequest, $objResponse) {

	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			case 'config':
				$this->getConfig($objRequest, $objResponse);
			break;
			case 'allproducts':
				$this->getProducts($objRequest, $objResponse);
			default:
				$this->doBase($objRequest, $objResponse);
			break;
		}
	}

	/**
	 * 首页显示 
	 */
	protected function doBase($objRequest, $objResponse) {
		echo "\'";
		//赋值
		//设置类别
		$objResponse -> nav = 'index';
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '我的网站', '我的网站', '我的网站'));
		$objResponse -> setTplName("www/base");
	}

	protected function getConfig($objRequest, $objResponse) {
		$objProcess = new process($this->process_key . 'BemyguestService');
		$objService = $objProcess->BemyguestService();
		print_r($objService->config());
	}
	
	protected function getProducts($objRequest, $objResponse) {
		$this->setDisplay();
		$objProcess = new process($this->process_key . 'BemyguestService');
		$objService = $objProcess->BemyguestService($this->process_key);
		$result = $objService->allproducts();
		$result = json_decode($result['result'], true);

		$total_pages = $result['meta']['pagination']['total_pages'];
		for($i = 1; $i <= $total_pages; $i++ ) {
			$result = $objService->allproducts($i);
			$result = json_decode($result['result'], true);
			foreach ($result['data'] as $k => $v) {
				$product = $objService->product($v['uuid']);
				$product = json_decode($product['result'], true);
				$objService->checkSaveProduct($product['data']);
			}
		}
		echo "over";
	}
	



}
?>