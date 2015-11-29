<?php
/**
 * PHP versions 5
 * @author     cooc <yemasky@msn.com>
 */
class CreateHtmlTool {
	public static $fileId = 'id,cid,title,pic,pic_local,vid,ext,simple_descs,descs,play_length,category,director,featured,areas,play_year,video_from,views,bbs_id';
	public static function createIndex($objRequest, $objResponse) {
		include(__ROOT_PATH . 'etc/channelConfig.php');
		$objVideoDao = new VideoDao();
		$arrVideo[0]['data']   = $objVideoDao -> getVideo("cid=1 AND play_year = '2012'", 'id DESC',self::$fileId,100);
		$arrVideo[0]['title']  = '电影';
		$arrVideo[0]['url']    = self::getHtmlUrl('movie', 'index');
		$arrVideo[1]['data']     = $objVideoDao -> getVideo(NULL, 'id DESC',self::$fileId,100, 'video_tv');
		$arrVideo[1]['title']  = '电视';
		$arrVideo[1]['url']    = self::getHtmlUrl('tv', 'index');
		$arrVideo[2]['data']   = $objVideoDao -> getVideo(NULL, 'id DESC',self::$fileId. ',series',100, 'video_anime');
		$arrVideo[2]['title']  = '动漫';
		$arrVideo[2]['url']    = self::getHtmlUrl('anime', 'index');
		$arrVideo[3]['data']   = $objVideoDao -> getVideo(NULL, 'id DESC',self::$fileId. ',series',100, 'video_variety');
		$arrVideo[3]['title']  = '综艺';
		$arrVideo[3]['url']    = self::getHtmlUrl('variety', 'index');
		$arrVideo[4]['data']   = $objVideoDao -> getVideo(NULL, 'id DESC',self::$fileId. ',series',100, 'video_music');
		$arrVideo[4]['title']  = '音乐';
		$arrVideo[4]['url']    = self::getHtmlUrl('music', 'index');
		foreach($arrVideo as $k => $v) {
			if($k == 0) {$channel = 'movie';$picext = '';}
			if($k == 1) {$channel = 'tv';$picext = 'tv';}
			if($k == 2) {$channel = 'anime';$picext = 'an';}
			if($k == 3) {$channel = 'variety'; $picext = 'va';}
			if($k == 4) {$channel = 'music';$picext = 'mu';}
			foreach($v['data'] as $kk => $vv) {
				$arrVideo[$k]['data'][$kk]['title'] = $arrVideo[$k]['title'] . ':' . $arrVideo[$k]['data'][$kk]['title'];
				//$arrVideo[$k]['data'][$kk]['url']   = self::getHtmlUrl($channel.self::createNum($vv['id']), $vv['id']);
				$seriesId = isset($vv['series']) ? $vv['series'] : NULL;
				$arrVideo[$k]['data'][$kk]['url']   = PathManager::getSiteUrl($channel, NULL, $vv['id'], $seriesId);
				//self::getHtmlUrl($channel.'/'.self::createNum($v['id']), $v['id']);
				$arrVideo[$k]['data'][$kk]['pic']   = __IMGWEB . $vv['pic_local'] . $vv['id'] . $picext . '.jpg';
			}
			$arrVideo[$k]['title'] = '最新' .$arrVideo[$k]['title'];
		}
		/*$arrTag = $objResponse -> arrTag;
		foreach($arrTag as $k => $v) {
			$i = 0;
			foreach($v as $kk => $vv) {
				$arrTagUrl[$k][$i]['url'] = PathManager::getSiteUrl($k, 1, NULL, $kk);
				$arrTagUrl[$k][$i]['title'] = $vv;
				$i++;
			}
			if($k == 'anime' || $k == 'music') break;
		}*/
		$objResponse -> arrVideo    = $arrVideo;
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('index', '免费电影，高清电影，免费电视剧，无广告，', '免费电影，高清电影，免费电视剧，无广告', '免费电影，高清电影，免费电视剧，无广告'));
	}
	
	public static function createChannel($objRequest, $objResponse) {
		$channel = $objRequest -> channel;
		$table = 'video';
		$channelTitle = '电影';
		$conditions = 'cid=1';
		if($channel == 'tv')      {$table = 'video_tv';     $conditions = NULL;$channelTitle = '电视剧';}
		if($channel == 'anime')   {$table = 'video_anime';  $conditions = NULL;$channelTitle = '动漫';}
		if($channel == 'variety') {$table = 'video_variety';$conditions = NULL;$channelTitle = '综艺';}
		if($channel == 'music')   {$table = 'video_music';  $conditions = NULL;$channelTitle = '音乐';}
		$objVideoDao = new VideoDao();
		$objVideoDao -> setTable($table);
		$dataCount = $objVideoDao -> getCount($conditions);
		$perpage = 50;
		$allpage = ceil($dataCount/$perpage);
		$shiftAllpage = $allpage;
		//$arrPages = PathManager::getPageArray($allpage, $pn);
		$arrPages = NULL;
		$fileId = self::$fileId;
		for($pn = 1; $pn<=$allpage; $pn++) {
			$limit = ($pn-1)*$perpage . ", 5";
			$title = '';
			$arrVideo = $objVideoDao -> getVideo($conditions, 'id ASC',$fileId,$limit,$table);
			foreach($arrVideo as $k => $v) {
				$title .= $channelTitle . $arrVideo[$k]['title'] . '在线看,';
			}
			$arrPages[$allpage-$pn]['title'] = $title . '，免费电影电视剧动漫';
			$arrPages[$allpage-$pn]['url']   = self::getHtmlUrl($channel, $pn);
		}
		$objResponse -> arrPages    = $arrPages;
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('index', '最新'.$channelTitle.'在线看', $arrPages[0]['title'], $arrPages[0]['title']));
	}
	
	public static function createChannelList($objRequest, $objResponse) {
		$pn = $objRequest -> pn;
		$channel = $objRequest -> channel;
		$table = 'video';
		$channelTitle = '电影';
		$picext = '';
		$conditions = 'cid=1';
		if($channel == 'tv')      {$table = 'video_tv';     $conditions = NULL;$channelTitle = '电视剧';$picext = 'tv';}
		if($channel == 'anime')   {$table = 'video_anime';  $conditions = NULL;$channelTitle = '动漫';$picext = 'an';}
		if($channel == 'variety') {$table = 'video_variety';$conditions = NULL;$channelTitle = '综艺';$picext = 'vr';}
		if($channel == 'music')   {$table = 'video_music';  $conditions = NULL;$channelTitle = '音乐';$picext = 'mu';}
		$fileId = self::$fileId;
		if($channel == 'movie') {
		} else {
			$fileId = $fileId . ',series';	
		}
		$objVideoDao = new VideoDao();
		$objVideoDao -> setTable($table);
		$dataCount = $objVideoDao -> getCount($conditions);
		$perpage = 50;
		$allpage = ceil($dataCount/$perpage);
		//$arrPages = PathManager::getPageArray($allpage, $pn);
		$arrPages = NULL;
		
		$limit = ($pn-1)*$perpage . ", $perpage";
		$arrVideo = $objVideoDao -> getVideo($conditions, 'id ASC',$fileId,$limit,$table);
		$title = '';
		foreach($arrVideo as $k => $v) {
			if($k < 6) $title .= $channelTitle . $arrVideo[$k]['title'] . '在线看,';
			$arrVideo[$k]['title'] = $channelTitle.':'.$arrVideo[$k]['title'] . '在线看';
			$seriesId = isset($v['series']) ? $v['series'] : NULL;
			$arrVideo[$k]['url']   = PathManager::getSiteUrl($channel, NULL, $v['id'], $seriesId);
			//self::getHtmlUrl($channel.'/'.self::createNum($v['id']), $v['id']);
			$arrVideo[$k]['pic']   = __IMGWEB . $v['pic_local'] . $v['id'] . $picext . '.jpg';
		}
		$objResponse -> arrVideo    = $arrVideo;
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('index', '最新'.$channelTitle.'在线看', $arrPages[0]['title'], $arrPages[0]['title']));
	}
	
	public static function getHtmlUrl($channel, $pn = NULL) {
		if(!empty($pn)) return __HTML_WEB . $channel . '/' . $pn . '.html';
	}
	
	public static function createUserInfoCache($arrValue, $uid) {
		self::createUserCache('userinfo', $arrValue, $uid);
	}
	
	public static function createNum($id) {
		if(strlen($id) >= 2) {
			$fileid = substr($id, -2);
		} elseif(strlen($id) == 1) {
			$fileid = '0' . $id;
		} else {
			$fileid = $id . '00';
		}
		return $fileid;
	}

}
?>