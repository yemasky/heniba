<?php
/**
 *-------------------------
 *
 * The show the detail of each product
 *
 * PHP versions 5

**/

class IndexAction extends BaseAction {
	
	protected function check($objRequest, $objResponse) {
		//if(getHost() == 'static.yelove.cn') redirect(__HTML_WEB . 'index.html');
		//if(getHost() != __WEB_KEY) redirect(__WEB);
		if($objRequest->getAction() != 'ajaxvideo') {// && 
			$cacheid = $objRequest -> cate . $objRequest -> channel . $objRequest -> tag . '#' 
				 . $objRequest -> pn . '#' . $objRequest -> s . 'content' 
				 . $objRequest -> series .'#'. $objRequest -> id;
			//Service::etag(__WEB. md5($cacheid) . date("Ymd H") . '-' . 60%2);
			if($objRequest -> pn <= 20 && $objRequest -> cate == 'channel') {
				$dir = 'index/';
				$rand = false;
				if(!empty($objRequest -> s)) {$dir = 'search/';$rand = true;$cacheid = md5($cacheid);}
				$this -> setCache($cacheid, true, 3600, __CACHE . $dir, $rand);
			}
		}
	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			case 'ajaxvideo':
				$this->doAjaxVideo($objRequest, $objResponse);
			break;
			case 'writereview':
				$this->doWriteReview($objRequest, $objResponse);
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
		$objRe = new WebServiceClient();
		$objRe->get()->send();
		$arrChannel = NULL;
		$arrShiftChannel = NULL;
		include(__ROOT_PATH . 'etc/channelConfig.php');
		foreach($arrChannel as $k => $v) {
			$arrChannel[$k]['url'] = PathManager::getSiteUrl($v['channel']);
		}
		$objResponse -> arrChannel      = $arrChannel;
		$objResponse -> arrShiftChannel = $arrShiftChannel;
		$objResponse -> s               = '';
		$objResponse -> fileId = 'id,cid,title,pic,pic_local,vid,ext,simple_descs,descs,play_length,'
								.'category,director,featured,areas,play_year,video_from,views,bbs_id,add_date';
		$objCookie = new Cookie;
		//$arrLoginUser = BaseComm::getLoginUser($objCookie);
		switch($objRequest -> cate) {
			case 'channel':
				if($objRequest -> channel == 'onlinetv') {
					$this -> doShowOnlineTv($objRequest, $objResponse);
				} else {
					$this->doShowChannel($objRequest, $objResponse);
				}
			break;
			case 'video':
				$this->doShowVideo($objRequest, $objResponse);
			break;
			case 'view':
				$this->doShowView($objRequest, $objResponse);
			break;
			default:
				if(isset($objRequest -> s)) {
					$this -> doSearch($objRequest, $objResponse);
				} else {
					$this->showIndex($objRequest, $objResponse);
				}
			break;
		}
		//$this -> recommend($objRequest, $objResponse);
		//设置tpl
		$objResponse -> setTplName("www/index");
	}
	
	protected function showIndex($objRequest, $objResponse) {
		$etag_ext = date("i") > 30 ? 0 : 1;
		//Service::etag('index-' . date("Ymd-H") . '-' . $etag_ext);
		$fileId = $objResponse -> fileId;
		$objCache = new DBCache();
		//$arrVideo = $objCache -> fetch('homepage', false, false);
		//$arrChannel = $objResponse -> arrChannel;
		
		//
		$arrTag = $objResponse -> arrTag;
		

		//赋值
		//设置类别
		$objResponse -> nav = 'index';
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '我的网站', '我的网站', '我的网站'));
	}
	
	protected function doShowChannel($objRequest, $objResponse) {

	}
	
	protected function doSearch($objRequest, $objResponse) {
		$channel = $objRequest -> channel;
		$pn = $objRequest -> pn;
		$s  = trim($objRequest -> s);
		$sort_sql = NULL;
		$conditions = $picext = $arrSortUrl = NULL;
		$arrShiftChannel = $objResponse -> arrShiftChannel;
		$arrChannel      = $objResponse -> arrChannel;
		$arrTag     = $objResponse -> arrTag;
		$arrAreas        = $objResponse -> arrAreas;
		
		$cid = 1;
		if(isset($arrShiftChannel[$channel])) {$cid = $arrShiftChannel[$channel];} else {$channel = 'movie';}
		$keyword = Searchkw::kw($s);
		$objVideoDao = new VideoDao();
		$objVideoDao -> setTable('search');
		$conditions = "cid = '$cid'";
		if(!empty($keyword)) $conditions = "MATCH (title) AGAINST ('$keyword' IN BOOLEAN MODE) AND " . $conditions;
		$dataCount = $objVideoDao -> getCount($conditions);
		$ft = true;
		if(empty($dataCount)) {
			$conditions = "title like'%$keyword%' AND cid = '$cid'";
			$dataCount = $objVideoDao -> getCount($conditions);
			$ft = false;
		}
		$perpage = 16;
		$allpage = ceil($dataCount/$perpage);
		$pn = $pn > $allpage ? $allpage : ($pn < 1 ? 1 : $pn);
		$arrPages = PathManager::getPageArray($allpage, $pn);
		$arrVideo = NULL;
		if(!empty($dataCount)) {
			foreach($arrPages as $k => $v) {
				if($v['pn'] == '#pn') {
					$arrPages[$k]['url'] = '#pn';
				} else {
					$arrPages[$k]['url'] = PathManager::getSiteUrl('search', $v['pn'], $s . '&channel='.$channel);
				}
			}
			$limit = ($pn-1)*$perpage . ", $perpage";
			$search_fileId = 'id';
			$search_sort = 'id DESC';
			if($ft) {
				$search_fileId = "id,MATCH (title) AGAINST ('$keyword' IN BOOLEAN MODE) match_num";
				$search_sort = "match_num DESC";
			} 
			
			$arrVideo = $objVideoDao -> getVideo($conditions, $search_sort, $search_fileId, $limit, 'search');
			$strId = '';
			if(!empty($arrVideo)) {
				foreach($arrVideo as $k => $v) $strId .= $v['id'] . ',';
			}
			$strId = trim($strId, ',');
			if(!empty($strId)) {$conditions = "id IN($strId)";$limit = NULL;}
			$fileId = $objResponse -> fileId;
			$sort_sql = empty($sort_sql) ? "find_in_set(id,'$strId')" : "find_in_set(id,'$strId') AND " . $sort_sql;
			$arrVideo = $objVideoDao -> getVideo($conditions,$sort_sql,$fileId,NULL, $channel);
			foreach($arrVideo as $k => $v) {
				//$channel = $arrChannel[$v['cid'] - 1]['channel'];
				$arrVideo[$k]['url']   = PathManager::getSiteUrl($channel, NULL, $arrVideo[$k]['id']);
				$arrVideo[$k]['descs'] = cutString($arrVideo[$k]['descs'],550).'...';
				if(isset($arrAreas[$arrVideo[$k]['areas'] - 1])) $arrVideo[$k]['areas'] = $arrAreas[$arrVideo[$k]['areas'] - 1]['areas'];
				$arrDate = explode('-', $arrVideo[$k]['add_date']);
				$arrVideo[$k]['Y'] = $arrDate[0];
				$arrVideo[$k]['M'] = $arrDate[1];
				$arrD              = explode(' ', $arrDate[2]);
				$arrVideo[$k]['D'] = $arrD[0];
				$arrVideo[$k]['T'] = $arrD[1];
				$arrBD_ALL_URL = explode('`|`', $arrVideo[$k]['vid']);
				$num = count($arrBD_ALL_URL);
				$j = 0;
				$arrBD4URL = NULL;
				for($i = $num - 1; $i >= 0; $i--) {
					if(isset($arrBD_ALL_URL[$i])) {
						$arrBD_title = explode('|', $arrBD_ALL_URL[$i]);
						$arrBD4URL[$j]['title'] = str_replace(array('.rmvb','.flv','.mkv','.mp4'), '', 
													strtolower($arrBD_title[count($arrBD_title) - 1]));
						$arrBD4URL[$j]['url']   = PathManager::getPlayUrl($channel, $arrVideo[$k]['id'], $i + 1);
					}
					$j++;
					if($j >= 4) break;
				}
				$arrVideo[$k]['BD_URL'] = $arrBD4URL;
			}
		}
		//
		$objResponse -> arrSortUrl   = $arrSortUrl;
		$objResponse -> s            = $s;
		$objResponse -> picext       = $picext;
		$objResponse -> p            = $pn;
		$objResponse -> allpage      = $allpage;
		$objResponse -> tag_title    = "搜索'$s'";
		$objResponse -> arrPage      = $arrPages;
		$objResponse -> arrVideo     = $arrVideo;
		$objResponse -> nav          = 'channel';
		$objResponse -> channel      = $channel;
		$objResponse -> channelTitle = '搜索';
		$objResponse -> arrTagUrl = '';

		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('video', "搜索'$s'","搜索'$s'","搜索'$s'"));
	}
	protected function doShowView($objRequest, $objResponse) {
		Service::etag('view-' . $objRequest -> channel . '-'. $objRequest -> id . '-' . $objRequest -> series . '-' . date("YmdH"));
		$this -> doShowVideo($objRequest, $objResponse);
		$arrVideoInfo = $objResponse -> arrVideoInfo;
		$objResponse -> nav          = 'view';
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('video', $arrVideoInfo['title'].'介绍及评论，电影评论,', $arrVideoInfo['descs'], $arrVideoInfo['descs']));
	}
	protected function doShowVideo($objRequest, $objResponse) {
		$id     = $objRequest -> id;
		$series = $objRequest -> series;
		if($objRequest -> cate == 'video') Service::etag('video-' . $objRequest -> channel . '-'. $id . '-' . $series);
		$arrShiftChannel = $objResponse -> arrShiftChannel;
		$arrChannel      = $objResponse -> arrChannel;
		$arrTag          = $objResponse -> arrTag;
		if($objRequest -> channel && isset($arrShiftChannel[$objRequest -> channel])) {
			$conditions['cid'] = $arrShiftChannel[$objRequest -> channel];
			$channel = $objRequest -> channel;
		} else {
			$conditions['cid'] = 1;
			$channel = 'movie';
		}
		$i = 0;
		$arrTagUrl = NULL;
		foreach($arrTag[$channel] as $k => $v) {
			$arrTagUrl[$i]['url'] = PathManager::getSiteUrl($channel, 1, NULL, $k);
			$arrTagUrl[$i]['title'] = $v;
			$i++;
		}
		$table = $channel;
		//
		$arrVideoInfo = $this -> getVideoSqlite($conditions['cid'], $id, $table);
		
		if(empty($arrVideoInfo)) redirect(__WEB . '404.htm');
		$arrVideoInfo[0]['url'] = PathManager::getSiteUrl($channel, NULL, $id);
		$title = $arrVideoInfo[0]['title'];
		$arrVideoVid = NULL;
		$arrSeriesURL = NULL;
		if($arrVideoInfo[0]['video_from'] == 'baidu') {
			$arrBD_ALL_URL = explode('`|`', $arrVideoInfo[0]['vid']);
			$num = count($arrBD_ALL_URL);
			$j = 0;
			for($i = 0; $i < $num; $i++) {
				if(empty($series)) $series = 1; 
				$arrBD_title = explode('|', $arrBD_ALL_URL[$i]);
				$arrSeriesURL[$i]['title'] = str_replace(array('.rmvb','.flv','.mkv','.mp4'), '', 
											strtolower($arrBD_title[count($arrBD_title) - 1]));
				$arrSeriesURL[$i]['url']   = PathManager::getPlayUrl($channel, $arrVideoInfo[0]['id'], $i + 1);
				if(($series - 1) == $i) {
					$arrVideoInfo[0]['vid'] = $arrBD_ALL_URL[$i];
					if($objRequest -> cate == 'video' && $num > 1) $title .=  '['.$arrSeriesURL[$i]['title'].']';
				}
			}
		}
		$arrVideoInfo = $arrVideoInfo[0];
		
		//$objResponse -> arrComment   = $this -> readComment($arrVideoInfo['bbs_id']);
		$objResponse -> series       = $series;
		$objResponse -> channel      = $channel;
		$objResponse -> arrVideoInfo = $arrVideoInfo;
		$objResponse -> arrVideoVid  = $arrVideoVid;
		$objResponse -> arrSeriesURL = $arrSeriesURL;
		$objResponse -> channelTitle = $arrChannel[$conditions['cid'] - 1]['title'];
		$objResponse -> title        = $title;
		//
		$objResponse -> arrTagUrl    = $arrTagUrl;
		$objResponse -> nav          = 'video';
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('video', $title .'在线看，免费电影,', $arrVideoInfo['descs'], $arrVideoInfo['descs']));
	}
	
	protected function doShowOnlineTv($objRequest, $objResponse) {
		$vid = $autoplay = $width = $height = $pic = $title = '';
		$k = $objRequest -> pn;
		$arrOnlineTv = NULL;
		include(__ROOT_PATH . 'etc/videoSiteConfig.php');
		$tv = $arrOnlineTv['300145'];
		if($k > 1) {
			$tv = $arrOnlineTv[$k];	
		}
		foreach($arrOnlineTv as $k => $v) {
			$arrOnlineTv[$k]['url'] = PathManager::getSiteUrl('onlinetv', $k);
		}
		//
		$objResponse -> arrSeries      = '';
		$objResponse -> arrOnlineTv    = $arrOnlineTv;
		$objResponse -> tv             = $tv;
		$objResponse -> channelTitle   = '视频';
		$objResponse -> nav = 'onlinetv';
		//设置Meta(共通)
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('video', $tv['title'].'卫视在线电视',$tv['title'].'卫视在线卫视，全天候网络在线播放',$tv['title'].'卫视'));
	}
	
	protected function recommend($objRequest, $objResponse) {
		
	}
		
	public function readComment($bbs_id = NULL) {
		return;
		
	}

	


}
?>