<?php
/**
 *-------------------------
 *
 * The show the detail of each product
 *
 * PHP versions 5

**/

class CreateHtmlAction extends BaseAction {
	
	protected function check($objRequest, $objResponse) {
		
	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			case 'channel':
				$this->createChannel($objRequest, $objResponse);
			break;
			case 'list':
				$this->createChannelList($objRequest, $objResponse);
			break;
			case 'create':
				$this->createList($objRequest, $objResponse);
			break;
			case 'index':
				$this->createIndex($objRequest, $objResponse);
			break;
			default:
				$this->doShowPage($objRequest, $objResponse);
			break;
		}
	}

	/**
	 * 首页显示 
	 */
	protected function doShowPage($objRequest, $objResponse) {
		$this -> setDisplay();
		//设置值
		//设置tpl
		$objResponse -> setTplName("index");
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta());
	}
	protected function createIndex($objRequest, $objResponse){
		$this -> setCreateHtml('index.html', __HTML);
		CreateHtmlTool::createIndex($objRequest, $objResponse);
		$objResponse -> setTplName("static/index");
	}
	protected function setIndex() {
		
	}
	protected function createChannel($objRequest, $objResponse){
		set_time_limit(0);
		$channel = $objRequest -> channel;
		File::createDir(__HTML . $channel);
		$this -> setCreateHtml('index.html', __HTML . $channel . '/');
		CreateHtmlTool::createChannel($objRequest, $objResponse);
		$objResponse -> setTplName("static/channel");
		
	}
	protected function createChannelList($objRequest, $objResponse){
		set_time_limit(0);
		$pn = $objRequest -> pn;
		if(empty($pn)) $pn = 1;
		$channel = $objRequest -> channel;
		File::createDir(__HTML . $channel);
		$this -> setCreateHtml($pn.'.html', __HTML . $channel . '/');
		CreateHtmlTool::createChannelList($objRequest, $objResponse);
		$objResponse -> setTplName("static/channellist");
	}
	
	protected function createList($objRequest, $objResponse){
		set_time_limit(0);
		$this -> setDisplay();
		$arrChannel = NULL;
		include(__ROOT_PATH . 'etc/channelConfig.php');
		$objVideoDao = new VideoDao();
		foreach($arrChannel as $k => $v) {
			if($k >= 5) break;
			file_get_contents(__WEB . 'index.php?model=createhtml&action=channel&channel='.$v['channel']);
			if($v['channel'] == 'movie') {
				$table = 'video';$conditions = 'cid=1';
			} else {
				$table = 'video_' . $v['channel'];$conditions = NULL;
			}
			$objVideoDao -> setTable($table);
			$dataCount = $objVideoDao -> getCount($conditions);
			$perpage = 50;
			$allpage = ceil($dataCount/$perpage);
			for($i = 1; $i <= $allpage; $i++) {
				file_get_contents(__WEB . 'index.php?model=createhtml&action=list&channel='.$v['channel'].'&pn='.$i);
			}
		}
		echo "over.";
	}
	
	

}
?>