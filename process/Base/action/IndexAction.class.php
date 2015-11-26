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
		$pn              = $objRequest -> pn;
		$tag             = $objRequest -> tag;
		$arrShiftChannel = $objResponse -> arrShiftChannel;
		$arrChannel      = $objResponse -> arrChannel;
		$arrTag          = $objResponse -> arrTag;
		$arrAreas        = $objResponse -> arrAreas;
		$sort_sql        = $conditions = $picext = NULL;
		
		if($objRequest -> channel && isset($arrShiftChannel[$objRequest -> channel])) {
			$conditions['cid'] = $arrShiftChannel[$objRequest -> channel];
			$channel = $objRequest -> channel;
		} else {
			$conditions['cid'] = 1;
			$channel = 'movie';
		}
		$cid = $conditions['cid'];
		$i = 0;
		$arrTagUrl = $tag_title = $sqlSeries = NULL;
		//tag 处理
		$arrSort = explode(',', $tag);
		if(isset($arrSort[0]) && $arrSort[0] > 0) {
			$conditions['category'] = $arrSort[0];	
		}
		$tag_id = 0;
		if(isset($arrSort[1]) && $arrSort[1] > 0) {
			$tag_id = $arrSort[1];	
		}
		$sortId = '';
		if(isset($arrSort[2]) && $arrSort[2] > 0) {
			if($arrSort[2] == 1) $sort_sql = 'views DESC';
			if($arrSort[2] == 2) $sort_sql = 'grade DESC';
			if($arrSort[2] == 3) $sort_sql = 'play_year DESC, id DESC';
			$sortId = $arrSort[2];
		}
		//end tag
		if(empty($sort_sql)) {
			$sort_sql = 'add_date DESC';
		} else {
			$sort_sql .= ', add_date DESC';
		}
		if(isset($arrSort[2]) && $arrSort[2] > 0) {
			//if($channel != 'music' || $channel != 'variety') $conditions['play_year'] = $arrSort[2];
		}
		foreach($arrTag[$channel] as $k => $v) {
			$arrTagUrl[$i]['url'] = PathManager::getSiteUrl($channel, 1, NULL, $k);
			$arrTagUrl[$i]['title'] = $v;
			if($k == $tag_id && $tag_id > 0) $tag_title = $v;
			$i++;
		}
		
		$objVideoDao = new VideoDao();
		$table = $channel;
		if($tag_id > 0) {
			$objVideoDao -> pk = 'tid';
			$objVideoDao -> setTable('tag_video');
			$dataCount = $objVideoDao -> getCount(array('tid'=>$tag_id, 'cid'=>$cid)); 
		} else {
			$objVideoDao -> setTable($table);
			$dataCount = $objVideoDao -> getCount($conditions); 
		}
		$perpage = 16;
		$allpage = ceil($dataCount/$perpage);
		$pn = $pn > $allpage ? $allpage : $pn;
		$pn = $pn < 1 ? 1 : $pn;
		$arrPages = PathManager::getPageArray($allpage, $pn);
		foreach($arrPages as $k => $v) {
			if($v['pn'] == '#pn') {
				$arrPages[$k]['url'] = '#pn';
			} else {
				$arrPages[$k]['url'] = PathManager::getSiteUrl($channel, $v['pn'], NULL, $tag);
			}
		}
		$fileId = $objResponse -> fileId . $sqlSeries;
		$limit = ($pn-1)*$perpage . ", $perpage";
		if($tag_id > 0) {
			$conditions = "id IN(0)";
			$arrVideo = $objVideoDao -> getVideo(array('tid'=>$tag_id,'cid'=>$cid), NULL,'id', $limit, 'tag_video');
			$strId = '';
			if(!empty($arrVideo)) {
				foreach($arrVideo as $k => $v) $strId .= $v['id'] . ',';
			}
			$strId = trim($strId, ',');
			if(!empty($strId)) {$conditions = "id IN($strId)";$limit = NULL;}
		}
		$objVideoDao -> pk = 'id';
		$arrVideo = $objVideoDao -> getVideo($conditions,$sort_sql,$fileId,$limit,$table);
		foreach($arrVideo as $k => $v) {
			$channel = $arrChannel[$v['cid'] - 1]['channel'];
			$seriesId = isset($arrVideo[$k]['series']) && $arrVideo[$k]['series'] > 0 ? $arrVideo[$k]['series'] : NULL;
			$arrVideo[$k]['url']   = PathManager::getSiteUrl($channel, NULL, $arrVideo[$k]['id'], $seriesId);
			//($channel, NULL, $v['id'], $seriesId)
			$arrVideo[$k]['descs'] = cutString($arrVideo[$k]['descs'],550) . '...';
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
		//sort url
		$sort_default = empty($tag_id) ? NULL : $tag_id;
		$arrSortUrl[0]['title'] = '最新更新[默认排序]'; 
		$arrSortUrl[0]['url']   = PathManager::getSiteUrl($channel, $pn, NULL, $sort_default);
		$arrSortUrl[1]['title'] = '观看最多'; 
		$arrSortUrl[1]['url']   = PathManager::getSiteUrl($channel, $pn, NULL, $tag_id . ',' . 1);
		$arrSortUrl[2]['title'] = '评分最高'; 
		$arrSortUrl[2]['url']   = PathManager::getSiteUrl($channel, $pn, NULL, $tag_id . ',' . 2);
		$arrSortUrl[3]['title'] = '上映年代由近到远';
		$arrSortUrl[3]['url']   = PathManager::getSiteUrl($channel, $pn, NULL, $tag_id . ',' . 3);
		$arrSortUrl[4]['title'] = '2012年';
		$arrSortUrl[4]['url']   = PathManager::getSiteUrl($channel, 1, NULL, $tag_id. ',' . $sortId . ',' . 2012);
		$arrSortUrl[5]['title'] = '2011年';
		$arrSortUrl[5]['url']   = PathManager::getSiteUrl($channel, 1, NULL, $tag_id. ',' . $sortId . ',' . 2011);
		$arrSortUrl[6]['title'] = '2010年';
		$arrSortUrl[6]['url']   = PathManager::getSiteUrl($channel, 1, NULL, $tag_id. ',' . $sortId . ',' . 2010);
		$arrSortUrl[7]['title'] = '2009';
		$arrSortUrl[7]['url']   = PathManager::getSiteUrl($channel, 1, NULL, $tag_id. ',' . $sortId . ',' . 2009);

		//
		$objResponse -> arrSortUrl   = $arrSortUrl;
		$objResponse -> picext       = $picext;
		$objResponse -> p            = $pn;
		$objResponse -> allpage      = $allpage;
		$objResponse -> arrPage      = $arrPages;
		$objResponse -> tag_title    = $tag_title;
		$objResponse -> arrVideo     = $arrVideo;
		$objResponse -> nav          = 'channel';
		$objResponse -> channelTitle = $arrChannel[$cid - 1]['title'];
		$objResponse -> channelUrl   = PathManager::getSiteUrl($channel);
		$objResponse -> arrTagUrl    = $arrTagUrl;
		//设置Meta(共通)
		$metaTitle = $arrChannel[$cid - 1]['title'] . ',' . $arrVideo[0]['title'] . ',' . $arrVideo[1]['title'];
		$objResponse -> setTplValue("__Meta", BaseComm::getMeta('movie', $tag_title . $metaTitle, $metaTitle . ',' . $tag_title, $metaTitle . ',' . $tag_title));
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
	protected function doWriteReview($objRequest, $objResponse) {
		$this -> setDisplay();
		$id      = $objRequest -> id;
		$channel = $objRequest -> channel;
		$series  = $objRequest -> series;
		$objVideoDao = new VideoDao();
		//getVideo($conditions = NULL, $sort = NULL, $fields = NULL, $limit = NULL, )
		$table = 'movie';
		if(empty($series)) {
			if($channel == 'music') $table = 'music';
			if($channel == 'variety') $table = 'variety';
		} else {
			if($channel == 'tv') $table = 'television';
			if($channel == 'anime') $table = 'anime';
		}
		$arrId = $objVideoDao -> getVideo(array('id'=>$id), NULL, 'bbs_id', 1, $table);
		if(empty($arrId)) {redirect(__BBS);} else {
			redirect(__BBS . 'forum.php?mod=post&action=reply&tid='.$arrId[0]['bbs_id']);
		}
	}
	
	protected function doAjaxVideo($objRequest, $objResponse) {
		$arrSpider = array('360spider','google','jike','sogou','baidu','soso');
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : NULL;
		if(!empty($user_agent)) {
			foreach($arrSpider as $k=>$v) {
				if(strpos($user_agent, $k) === false){}else{
					echo 'Notice: Undefined index: HTTP_ACCEPT_ENCODING in /var/www/funcCommon.class on line 219';
					$this -> setDisplay();	
					writeLog('user_agent.log', $user_agent);
					return;
				};
			}
		}
		if(strpos(getReferUrl(), __WEB) === false) {
			echo 'Notice: Undefined index: HTTP_ACCEPT_ENCODING in /var/www/funcCommon.java on line 218';
			$this -> setDisplay();
		} else {
			$pic      = $objRequest -> pic;
			$title    = $objRequest -> title;
			$width    = $objRequest -> width;
			$height   = $objRequest -> height;
			$vid      = $objRequest -> vid;
			$site     = $objRequest -> site;
			$bbs_id   = $objRequest -> bbs_id;
			$autoplay = $objRequest -> autoplay == '' ? 0 : 1;
			$arrVideoSiteConfig = NULL;
			include(__ROOT_PATH . 'etc/videoSiteConfig.php');
			$objResponse -> strVideoSite = $arrVideoSiteConfig[$site];
			$objResponse -> setTplName("#index_ajax_video");
			if($site == 'onlinetv') return;
			//add views
			$id        = $objRequest -> id;
			$channel   = $objRequest -> channel;
			$series    = $objRequest -> series;
			$objVideoDao = new VideoDao();
			$table = 'movie';
			if($channel == 'tv' && $series > 0) $table = 'television';
			if($channel == 'anime' && $series > 0) $table = 'anime';
			if($channel == 'music') $table = 'music';
			if($channel == 'variety') $table = 'variety';
			$objVideoDao -> setTable($table);
			$objVideoDao -> increase("id='$id'", 'views');
			//bbs
			if(empty($bbs_id)) {
				$fileId = 'id,cid,title,pic,pic_local,vid,ext,simple_descs,descs,play_length,category,'
						 .'director,featured,areas,play_year,video_from,views,bbs_id';
				$arrVideoInfo = $objVideoDao -> getVideo("id='$id'", NULL, $fileId, NULL, $table);
				if(empty($arrVideoInfo)) return;
				if($arrVideoInfo[0]['bbs_id'] > 0) return;
				$bbs_tablepre = __bbs_tablepre;
				$fid = '2';
				$picext = '';
				if($channel == 'television') {$fid = 36;}
				if($channel == 'anime') {$fid = 37;}
				if($channel == 'music') {$fid = 39;}
				if($channel == 'variety') {$fid = 38;}
				
				$objVideoDao = new VideoDao(__BBS_DSN);
				$objVideoDao -> setTable($bbs_tablepre . 'forum_thread');
				$arrInsertData['fid'] = $fid;
				$arrInsertData['dateline'] = $arrInsertData['lastpost'] = time();
				$arrInsertData['views'] = 1;
				$arrInsertData['author'] = '天涯剑客';
				$arrInsertData['authorid'] = '2';
				$arrInsertData['subject'] = $arrVideoInfo[0]['title'] . '的评论,' . $arrVideoInfo[0]['category'];
				$arrInsertData['tid'] = $objVideoDao -> insertData($arrInsertData);
				
				unset($arrInsertData['lastpost']);
				unset($arrInsertData['views']);
				$objVideoDao -> setTable($bbs_tablepre . 'forum_post');
				$arrPid = $objVideoDao -> getVideo(NULL, 'pid desc', 'max(pid) pid', NULL, $bbs_tablepre . 'forum_post');
				$arrInsertData['pid'] = $arrPid[0]['pid'] + 1;
				$arrInsertData['first'] = 1;
				$pic = __PIC . 'pic.php?cid=' . $arrVideoInfo[0]['cid'] . $arrVideoInfo[0]['id'];
				$url = PathManager::getSiteUrl($channel, NULL, $id, $series);
				$arrInsertData['message'] = '[url='.PathManager::getSiteUrl($channel, NULL, $id, $series).'][img]'
											.$pic.'[/img][/url]    '
											.'    [url='.$url.']'.$arrVideoInfo[0]['title']
											."[/url] - [url=".$url.']点击在线观看[/url] ' 
											.$arrVideoInfo[0]['category'] 
											."\r\n\r\n主演：".addslashes($arrVideoInfo[0]['featured'])
											."\r\n\r\n导演：".addslashes($arrVideoInfo[0]['director'])."\r\n\r\n地区：".$arrVideoInfo[0]['areas']
											."\r\n\r\n".addslashes($arrVideoInfo[0]['descs']);
								$arrInsertData['smileyoff'] = -1;
				$objVideoDao -> insertData($arrInsertData);
				$objVideoDao -> setTable($bbs_tablepre . 'forum_post_tableid');
				$objVideoDao -> insertIgnoreData(array('pid'=>$arrInsertData['pid']));
				$arrAttach['tid'] = $arrInsertData['tid'];
				$arrAttach['pid'] = $arrInsertData['pid'];
				$arrAttach['uid'] = '2';
				$arrAttach['tableid'] = substr($arrAttach['tid'],-1);
				$objVideoDao -> setTable($bbs_tablepre . 'forum_attachment');
				$arrAttach['aid'] = $objVideoDao -> insertData($arrAttach);
				$arrAttach['filename'] = $arrVideoInfo[0]['title'];
				$arrAttach['attachment'] = $pic;
				$arrAttach['description'] = $arrVideoInfo[0]['title'];
				$arrAttach['dateline'] = time();
				$arrAttach['isimage'] = '1';
				$objVideoDao -> setTable($bbs_tablepre . 'forum_attachment_'.$arrAttach['tableid']);
				unset($arrAttach['tableid']);
				$objVideoDao -> insertData($arrAttach);
				$objVideoDao -> setDsn();
				$objVideoDao -> setTable($table);
				$objVideoDao -> update("id='$id'", array('bbs_id'=>$arrInsertData['tid']));

			}
		}
	}
	
	protected function getVideoSqlite($cid, $id, $table) {
		$arrVideoInfo = NULL;
		$sqliteDB_id_db = __SQLITE_VIDEO_DATA . PathManager::creatNumFileId($id, 4, 3000, 'video_') . '.db';
		$create_table   = false;
		$arrVideo = NULL;
		if(file_exists($sqliteDB_id_db)) {
			$sqliteDB   = new PDO("sqlite:" . $sqliteDB_id_db);
			$result = $sqliteDB->query("SELECT contents FROM video WHERE cid = '$cid' AND id='$id';");
			//获取第一行数据
			if($result != false) {
				$arrVideo = $result->fetch(); 
				$video_contents = trim(trim(trim($arrVideo['contents'], '['),']'));
				if(empty($video_contents)) {
					$arrVideo['contents'] = NULL;
					$result -> closeCursor();
					$sqliteDB = NULL;
				}
			} else {
				$arrErrorInfo = $sqliteDB -> errorInfo();
				throw new Exception($arrErrorInfo[0] . ';' . $arrErrorInfo[1] . ';' . $arrErrorInfo[2]);
			}
		} else {
			$create_table = true;
		}
		if(isset($arrVideo['contents']) && !empty($arrVideo['contents'])) {
			$arrVideoInfo = json_decode($arrVideo['contents'], true);
		} else {
			$objVideoDao  = new VideoDao();
			$arrVideoInfo = $objVideoDao -> getVideo("id='$id'", NULL, NULL, NULL, $table);
			$videoInfo = json_encode($arrVideoInfo);
			$sqliteDB       = new PDO("sqlite:" . $sqliteDB_id_db);
			if($create_table) {
				try {
					$sqliteDB->exec('CREATE TABLE video (id bigint(20) NOT NULL,cid mediumint(3) DEFAULT NULL,contents TEXT);'); 
					$sqliteDB->exec('CREATE UNIQUE INDEX id_cid ON pic(id, cid);');
				} catch (PDOException $e) {
				   throw new Exception($e->getMessage());
				}

			}
			if(!$sqliteDB->query("DELETE FROM video WHERE id = '$id' AND cid = '$cid';")) {
				$arrErrorInfo = $sqliteDB -> errorInfo();
				throw new Exception($arrErrorInfo[0] . ';' . $arrErrorInfo[1] . ';' . $arrErrorInfo[2]);	
			}
			if(!$sqliteDB->query("INSERT INTO video(id, cid, contents) VALUES ('$id', '$cid', '$videoInfo')")) {
				$arrErrorInfo = $sqliteDB -> errorInfo();
				throw new Exception($arrErrorInfo[0] . ';' . $arrErrorInfo[1] . ';' . $arrErrorInfo[2]);	
			}
			/*try {
				$sqliteDB->exec("DELETE FROM video WHERE id = '$id' AND cid = '$cid';");
				$sqliteDB->exec("INSERT INTO video(id, cid, contents) VALUES ('$id', '$cid', '$videoInfo')");
			} catch (PDOException $e) {
			   throw new Exception($e->getMessage());
			}*/
		}	
		return $arrVideoInfo;
	}
}
?>