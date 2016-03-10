<?php
/**
 *-------------------------
 *
 * The show the detail of each product
 *
 * PHP versions 5

**/
namespace supplier;

class BemyguestAction extends \BaseAction {
	protected function check($objRequest, $objResponse) {
		$this->setDisplay();
	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			case 'config':
				$this->getConfig($objRequest, $objResponse);
			break;
			case 'allproducts':
				$this->getAndInsertProducts($objRequest, $objResponse);
			break;
			case 'totourism':
				$this->insertToTourism($objRequest, $objResponse);
			break;
			case 'checkerror':
				$this->checkErrorProduct($objRequest, $objResponse);
				break;
			case 'getsource':
				$this->getBemyguestSourceProduct($objRequest, $objResponse);
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

	protected function getConfig($objRequest, $objResponse) {
		$objBemyguestService = new BemyguestService();
		print_r($objBemyguestService->config());
	}
	
	protected function getAndInsertProducts($objRequest, $objResponse) {
		$pn = $objRequest->pn;
		$pn = empty($pn) ? 1 : $pn;
		$objBemyguestService = new BemyguestService();

		$result = $objBemyguestService->allproducts();
		$result = json_decode($result['result'], true);

		$total_pages = $result['meta']['pagination']['total_pages'];
		for($i = $pn; $i <= $total_pages; $i++ ) {
			$result = $objBemyguestService->allproducts($i);
			$result = json_decode($result['result'], true);
			if(empty($result) || !isset($result['data'])) {
				throw new \Exception('result is empty');
			}
			foreach ($result['data'] as $k => $v) {
				$product = $objBemyguestService->product($v['uuid']);
				$product = json_decode($product['result'], true);
				//print_r($product);exit;
				$objBemyguestService->checkSaveProduct($product['data']);
				$product = null;
			}
		}
		echo "over";
	}
	
    protected function insertToTourism($objRequest, $objResponse) {
		$ojbBemyguestTool = new BemyguestTool();
		$ojbBemyguestTool->parserTourProduct();
	}

	protected function checkErrorProduct($objRequest, $objResponse) {
		$ojbBemyguestTool = new BemyguestTool();
		$ojbBemyguestTool->reSaveErrorProduct();
	}

	protected function getBemyguestSourceProduct($objRequest, $objResponse) {
		$uuid = $objRequest->uuid;
		$objBemyguestService = new BemyguestService();
		$arrayResult = $objBemyguestService->product($uuid, NULL, -1);
		if($arrayResult['httpcode'] == 200) {
			print_r(json_decode($arrayResult['result'], true));
		} else {
			print_r($arrayResult);
		}

	}

}
?>