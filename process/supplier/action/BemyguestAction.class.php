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
		//赋值
		//设置类别
		$objResponse -> nav = 'index';
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '我的网站', '我的网站', '我的网站'));
		$objResponse -> setTplName("www/base");
	}

	protected function getConfig($objRequest, $objResponse) {
		$this->setDisplay();
		//$objProcess = new Process($this->process_key . 'BemyguestService');
		$objService = $this->objProcess->BemyguestService($this->process_key);
		print_r($objService->config());
	}
	
	protected function getProducts($objRequest, $objResponse) {
		$this->setDisplay();
		$pn = $objRequest->pn;
		$pn = empty($pn) ? 1 : $pn;
		//$objProcess = new Process($this->process_key . 'BemyguestService');
		$objService = $this->objProcess->BemyguestService($this->process_key);
		$result = $objService->allproducts();
		$result = json_decode($result['result'], true);

		$total_pages = $result['meta']['pagination']['total_pages'];
		for($i = $pn; $i <= $total_pages; $i++ ) {
			$result = $objService->allproducts($i);
			$result = json_decode($result['result'], true);
			foreach ($result['data'] as $k => $v) {
				$product = $objService->product($v['uuid']);
				$product = json_decode($product['result'], true);
				//print_r($product);exit;
				$objService->checkSaveProduct($product['data']);
			}
		}
		echo "over";
	}
	



}
?>