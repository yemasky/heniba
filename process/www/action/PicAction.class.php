<?php
/**
 *-------------------------
 *
 * The show the detail of each product
 *
 * PHP versions 5

**/

class PicAction extends BaseAction {
	
	protected function check($objRequest, $objResponse) {
	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
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
		$cid = $objRequest -> cid;
		$id  = $objRequest -> id;
		if(empty($cid) || empty($id)) return;
		Service::etag(__WEB. $cid . '-' . $id);
		$arrPic = NULL;
		$sqliteDB_id_db = __SQLITE_DATA . PathManager::creatNumFileId($id, 4, 2000) . '.db';
		if(file_exists($sqliteDB_id_db)) {
			$sqliteDB       = new PDO("sqlite:" . $sqliteDB_id_db);
			$result = $sqliteDB->query("SELECT pic_bin FROM pic WHERE cid= '$cid' AND id='$id';");
			//获取第一行数据
			$arrPic = $result->fetch();
		}
		if(isset($arrPic['pic_bin'])) {
			if(empty($arrPic['pic_bin'])) {
				$arrPic['pic_bin'] = $this -> getPic($cid, $id);
			} else {
				if(substr($arrPic['pic_bin'], 0, 2) == '<!') $arrPic['pic_bin'] = $this -> getPic($cid, $id);
			}
		} else {
			$arrPic['pic_bin'] = $this -> getPic($cid, $id);
		}
		header("Accept-Ranges: bytes");
		header("Content-Type: image/jpeg");
		header("Content-Length: " .strlen($arrPic['pic_bin']));
		header("Last-Modified: Thu, 04 Apr 2013 09:32:17 GMT");
		echo $arrPic['pic_bin'];
	}
	
	protected function getPic($cid, $id) {
		$arrChannel = NULL;
		include(__ROOT_PATH . 'etc/channelConfig.php');
		$objPicDao = new PicDao();
		$objPicDao -> setTable($arrChannel[$cid - 1]['channel']);
		$url = $objPicDao -> getOne(array('id'=>$id), 'url');
		$content = file_get_contents('http://www.bdzy.cc' . $url);
		$content = iconv('GBK', 'UTF-8', $content);
		preg_match('/<!--影片图片开始代码-->([\s\S]+?)<!--影片图片结束代码-->/', $content, $arrPic);
		$pic = trim(trim($arrPic[1]));
		if(substr($pic, 0, 7) != 'http://') $pic = 'http://www.bdzy.cc' . $pic;
		$pic_bin = file_get_contents($pic);
		
		$sqliteDB_id_db = __SQLITE_DATA . PathManager::creatNumFileId($id, 4, 2000) . '.db';
		$create_table   = false;
		if(!file_exists($sqliteDB_id_db)) $create_table = true;
		$sqliteDB       = new PDO("sqlite:" . $sqliteDB_id_db);
		if($create_table) {
			$sqliteDB->exec('CREATE TABLE pic (id bigint(20) NOT NULL,cid mediumint(3) DEFAULT NULL,pic_bin longblob);'); 
			$sqliteDB->exec('CREATE UNIQUE INDEX id_cid ON pic(id, cid);');
		}
		$stmt           = $sqliteDB->prepare("INSERT INTO pic VALUES ('$id', '$cid', ?)"); 
		$stmt->bindValue(1, $pic_bin, PDO::PARAM_LOB); 
		$stmt->execute(); 
		return $pic_bin;
	}
	
}
?>