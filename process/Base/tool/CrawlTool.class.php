<?php
/**
 * PHP versions 5
 * @author     cooc <yemasky@msn.com>
 */
class CrawlTool {
	public $fileDirId = '';
	public $year = '';
	public static function CrawlMovie($objRequest, $objResponse) {
		set_time_limit(0);
		//$objSmtpMail = new SmtpMail;
		//$objSmtpMail -> smtp("smtp.163.com", 25, 'mail.smtp.auth', 'chinaosc', 'luochi');
		//http://movie.youku.com/search/index2/_page63561_34_cmodid_63561;
		$objCrawlDao = new CrawlDao();
		$objCrawlDao -> setTable('video');
		for($i = 34; $i>=1; $i--) {
			$movie_url = 'http://movie.youku.com/search/index2/_page63561_'.$i.'_cmodid_63561';
			$content = GetContent::simpleGetCurl($movie_url, 'youku');//echo $content;exit;
			if(empty($content)) {writeLog('#craw.youku.url.error.get.log','爬取'. $movie_url);continue;}//echo $content;
			$content = self::matchList($content);
			//
			preg_match_all('/<script type="text\/javascript">([\s\S]+?)<\/script>/', $content, $arrMovie);
			//print_r($arrMovie[1]);
			preg_match_all('/<img src="([0-9a-zA-Z\:\/\.]+?)" alt="/', $content, $arrPic);
			preg_match_all('/http:\/\/v\.youku.com\/v_show\/id_([0-9a-zA-Z\=]+?).html"  target="_blank"><\/a>/', $content, $arrVid);//print_r($arrVid);
			if(!empty($arrMovie[1])) {
				foreach($arrMovie[1] as $k => $v) {
					preg_match('/showname : \'([\s\S]+?)\',/', $v, $arrTitle);
					if(empty($arrTitle[1])){writeLog('#craw.youku.url.error.get.log','no title'. $movie_url);continue;}
					$arrYoukeMovie['title'] = $arrTitle[1];
					$arrYoukeMovie['vid']   = $arrVid[1][$k];
					$arrYoukeMovie['pic']   = $arrPic[1][$k];
					//preg_match('/show_intro : "([\s\S]+?)\.\.\.",/', $v, $arrIntro);
					//$arrYoukeMovie['descs'] = $arrIntro[1];
					preg_match('/performer :([\s\S]+?)tv_station :/', $v, $arrPerformer);
					preg_match_all('/name : \'([\s\S]+?)url/', $arrPerformer[1], $arrPerformer);
					$arrFeatured = NULL;
					if(!empty($arrPerformer[1])) {
						foreach($arrPerformer[1] as $kk => $vv) {
							$vv = trim(trim(str_replace('\',', '', trim(trim($vv)))));
							$arrFeatured[$vv] = $vv;
						}
						sort($arrFeatured);
					}
					$arrYoukeMovie['featured'] = $arrFeatured;
					preg_match('/popData_([0-9]+?)_([0-9a-zA-Z]+?) = \{/', $v, $arrId);//print_r($arrId);exit;
					$url = 'http://www.youku.com/show_page/id_z'.$arrId[2].'.html';
					$content = GetContent::simpleGetCurl($url, 'youku');//echo $content;exit;
					$is_id = $objCrawlDao -> getOne(array('md5id'=>$url));
					if($is_id > 0) continue;
					preg_match('/<div class="left">([\s\S]+?)<div class="right">/', $content, $arrMovieInfo);
					preg_match('/<label>上映:<\/label>([0-9\-]+?)<\/span>/', $arrMovieInfo[1], $arrDate);
					$arrYoukeMovie['play_year'] = substr($arrDate[1], 0, 4);
					preg_match('/<label>地区:<\/label>([\s\S]+?)<\/span>/', $arrMovieInfo[1], $arrAreas);
					preg_match_all('/target="_blank">([\s\S]+?)<\/a>/', $arrAreas[1], $arrAreas);
					$arrYoukeMovie['areas'] = $arrAreas[1];
					preg_match('/<label>类型:<\/label>([\s\S]+?)<\/span>/', $arrMovieInfo[1], $arrCategory);
					preg_match_all('/\.html">([\s\S]+?)<\/a>/', $arrCategory[1], $arrCategory);
					$arrYoukeMovie['category'] = $arrCategory[1];
					preg_match('/<label>导演:<\/label>([\s\S]+?)<\/span>/', addslashes($arrMovieInfo[1]), $arrDirector);
					preg_match_all('/target="_blank">([\s\S]+?)<\/a>/', $arrDirector[1], $arrDirector);
					$arrYoukeMovie['director'] = $arrDirector[1];
					preg_match('/<label>时长:<\/label>([0-9]+?)分钟/', $arrMovieInfo[1], $play_length);
					$arrYoukeMovie['play_length'] = $play_length[1];
					preg_match('/<span class="long" style="display:none;">([\s\S]+?)<\/span>/', $arrMovieInfo[1], $descs);
					if(empty($descs[1])) {
						preg_match('/<span class="short" style="display:block;">([\s\S]+?)<\/span>/', $arrMovieInfo[1], $descs);
					}
					$arrYoukeMovie['descs'] = addslashes($descs[1]);//print_r($arrYoukeMovie);if($k >= 5)exit;
					self::insertMovie($arrYoukeMovie, $url, $objRequest, 'video');
				}
			}else{writeLog('#craw.youku.url.error.match.log','爬取'. $movie_url);continue;}//print_r($arrValue);exit;
		}
		echo "over";
	}
	
	public static function matchList($content) {
		preg_match('/<!-- 通栏图片竖版 -->([\s\S]+?)<!--coll end-->/', $content, $arrValue);
		if(isset($arrValue[1]) && !empty($arrValue[1]))return $arrValue[1];
		return NULL;
	}
	
	public static function insertMovie($arrVideo, $arrUrl, $objRequest, $table, $cid = 1) {
		if(empty($arrVideo['vid'])) {writeLog('#craw.youku.url.error.noVid.log','no vid:'. $arrUrl);return;}
		$fileDirId = date("z");
		$year = date("Y");
		$objCrawlDao = new CrawlDao();
		$objCrawlDao -> setTable($table);

		$arrDirectors = $arrVideo['director'];
		$arrVideo['director'] = !empty($arrVideo['director']) ? implode(' / ', $arrVideo['director']) : NULL;
		$arrFeatured  = $arrVideo['featured'];
		$arrVideo['featured'] = !empty($arrVideo['featured']) ? implode(' / ', $arrVideo['featured']) : NULL;
		$arrCategory  = $arrVideo['category'];
		$arrVideo['category'] = !empty($arrVideo['category']) ? implode(' / ', $arrVideo['category']) : NULL;
		$arrAreas  = $arrVideo['areas'];
		$arrVideo['areas'] = implode(' / ', $arrVideo['areas']);
		$arrVideo['video_from'] = 'youku';
		$arrVideo['cid'] = $cid;
		$arrVideo['pic_local']  = $year . '/' . $fileDirId . '/';
		$arrVideo['md5id'] = md5($arrUrl);
		//print_r($arrVideo);exit;
		$id = $objCrawlDao -> insertIgnoreData($arrVideo);
		if($id > 0) {
			//search
			$arrVideoDataSearch['id'] = $id;
			$arrVideoDataSearch['title']= Searchkw::kw($arrVideo['title']);
			$arrVideoDataSearch['descs']= Searchkw::kw($arrVideo['descs']);
			$objCrawlDao -> setTable('video_search');
			$objCrawlDao -> insertData($arrVideoDataSearch);
			//
			if(!empty($arrCategory))
				foreach($arrCategory as $k => $v) {
					$v = trim($v);
					if(!empty($v)) {
						if(strpos($v, '片') === false) $v = trim(trim($v)) . '片';
						$objCrawlDao -> setTable('tag');
						$tid = $objCrawlDao -> getOne(array('tag'=>trim($v), 'tag_type'=>0), 'id');
						if(empty($tid)) {
							$tid = $objCrawlDao -> insertData(array('tag'=>trim($v), 'tag_type'=>'0'));
						}
						$objCrawlDao -> setTable('tag_video');
						$objCrawlDao -> insertIgnoreData(array('tid'=>$tid, 'video_id'=>$id));
					}
				}
			
			foreach($arrAreas as $k => $v) {
				$v = trim($v);
				if(!empty($v)) {
					$objCrawlDao -> setTable('tag');
					$tid = $objCrawlDao -> getOne(array('tag'=>trim($v), 'tag_type'=>0), 'id');
					if(empty($tid)) {
						$tid = $objCrawlDao -> insertData(array('tag'=>trim($v), 'tag_type'=>'0'));
					}
					$objCrawlDao -> setTable('tag_video');
					$objCrawlDao -> insertIgnoreData(array('tid'=>$tid, 'video_id'=>$id));
				}
			}
			//$director
			//$arrDirector = explode(' ', $director);
			if(!empty($arrDirectors)) {
				foreach($arrDirectors as $k => $v) {
					$v = trim($v);
					if(!empty($v)) {
						$objCrawlDao -> setTable('tag');
						$tid = $objCrawlDao -> getOne(array('tag'=>trim($v), 'tag_type'=>1), 'id');
						if(empty($tid)) {
							$tid = $objCrawlDao -> insertData(array('tag'=>trim($v), 'tag_type'=>'1'));
						}
						$objCrawlDao -> setTable('tag_video');
						$objCrawlDao -> insertIgnoreData(array('tid'=>$tid, 'video_id'=>$id));
					}
				}
			}
			
			//$arrFeatured = explode(' ', $featured);
			if(!empty($arrFeatured)) {
				foreach($arrFeatured as $k => $v) {
					$v = trim($v);
					if(!empty($v)) {
						$objCrawlDao -> setTable('tag');
						$tid = $objCrawlDao -> getOne(array('tag'=>trim($v), 'tag_type'=>'2'), 'id');
						if(empty($tid)) {
							$tid = $objCrawlDao -> insertData(array('tag'=>trim($v), 'tag_type'=>'2'));
						}
						$objCrawlDao -> setTable('tag_video');
						$objCrawlDao -> insertIgnoreData(array('tid'=>$tid, 'video_id'=>$id));
					}
				}
			}
			
			File::createDir(__DEFAULT_IMG . $year); 
			File::createDir(__DEFAULT_IMG . $year . '/' . $fileDirId);
			//File::createDir(__DEFAULT_IMG . $year . '/' . $fileDirId . '/' . $part);
			copy($arrVideo['pic'], __DEFAULT_IMG .  $year . '/' . $fileDirId . '/' . $id . '.jpg');
		}
	}
	
	
	
	
	
	
	
	
	public static function matchListUrl($content) {
		preg_match_all('/href="([a-z0-9\:\/\.]+?)" class="mod_poster_130"/', $content, $arrUrlValue);
		preg_match_all('/src="([\s\S]+?)"/', $content, $arrPicValue);
		$arrValue = NULL;
		if(isset($arrUrlValue[1]) && !empty($arrUrlValue[1]) && $arrPicValue[1] && !empty($arrPicValue[1])) {
			foreach($arrUrlValue[1] as $k => $v) {
				$arrValue[$k]['url'] = $v;
				$arrValue[$k]['pic'] = $arrPicValue[1][$k];
			}
		}
		return $arrValue;
	}
	
	public static function matchMovie($arrUrl, $objRequest, $table) {
		$url = $arrUrl['url'];
		//$url = 'http://v.youku.com/cover/e/ejta73hgc23ajk1.html';
		$objCrawlDao = new CrawlDao(__JULEV_DSN);
		$objCrawlDao -> setTable($table);
		if($objCrawlDao -> getOne("md5id = '".md5($url)."'", 'id') > 0 ) {
			writeLog('#craw.youku.movie.md5id.error.log', $url . '相同MD5');
			return;
		}
		$content = GetContent::simpleGetCurl($url, 'youku');
		preg_match('/var COVER_INFO = ([\s\S]+?)var VIDEO_INFO/', $content, $arrCover);
		preg_match('/var VIDEO_INFO=([\s\S]+?)var PLAYER_INFO/', $content, $arrVideo);
		preg_match('/<ul class="details_list clearfix">([\s\S]+?)<\/ul>/', $content, $arrDetails);
		preg_match('/<p class="mod_cont">([\s\S]+?)<\/p>/', $content, $arrDesc);
		$arrMovie = NULL;
		if(isset($arrDetails[1]) && !empty($arrDetails[1])) {
			$arrDetails[1] = trim(trim($arrDetails[0]));
			$arrDetails[1] = str_replace(array('&','?',"\t","\r\n","\n"), '', $arrDetails[1]);//print_r($arrDetails[1]);
			//$arrDetails[1] = preg_replace('/<!--([0-9\-\.]+?)-->/', '', $arrDetails[1]);print_r($arrDetails[1]);
			$objXML = new xmlToArrayParser($arrDetails[1]);
			$arrValue = $objXML->array; //print_r($arrValue);exit;
			if($objXML->parse_error) {
				//print_r($objXML->get_xml_error());
				writeLog('#craw.youku.xml.error.match.log',$url . '<=>' . $objXML->get_xml_error());
			} else {
				$arrMovie['director']     = '';//self::getCdataArray($arrValue['ul']['li'][0]['div']['a']);
				$arrMovie['featured']     = '';//self::getCdataArray($arrValue['ul']['li'][1]['div']['a']);
				$arrMovie['areas']        = '';//self::getCdataArray($arrValue['ul']['li'][2]['a']);
				$arrMovie['play_year']    = '';//self::getCdataArray($arrValue['ul']['li'][3]['a']);
				$arrMovie['category']     = '';//self::getCdataArray($arrValue['ul']['li'][4]['a']);
				$arrMovie['play_length']  = '';//str_replace(array('时长：','分钟'),'',($arrValue['ul']['li'][5]['cdata']));
				$arrMovie['descs']  = '';
				foreach($arrValue['ul']['li'] as $k => $v) {
					$arrMatch = self::getCdataMatch($v);
					$arrMovie[$arrMatch[0]] = $arrMatch[1];
				}
				if($arrMovie['play_year'] == '其他') $arrMovie['play_year'] = date("Y");
			}
		}//print_r($arrMovie);exit;
		//var_dump(trim(trim($arrVideo[1]), ';'));exit;
		if(isset($arrVideo[1]) && !empty($arrVideo[1])) {//
			preg_match('/vid:"([0-9a-z\|]+?)"/i', $arrVideo[1], $arrVid);
			$arrVid = explode('|', $arrVid[1]);
			$arrMovie['vid'] = $arrVid[0];
			preg_match('/title:"([\s\S]+?)"/', $arrVideo[1], $arrTitle);
			$arrMovie['title'] = $arrTitle[1];
			$arrMovie['md5id'] = md5($url);
			$arrMovie['pic'] =$arrUrl['pic'];
		}
		if(isset($arrDesc[1]) && !empty($arrDesc[1])) {//print_r(trim(trim($arrVideo[1]), ';'));
			$arrMovie['descs'] = addslashes(trim(trim($arrDesc[1])) . '.' . $arrMovie['descs']);
		}
		return $arrMovie;
	}
	
	public static function getCdataMatch($arrValue) {//print_r($arrValue);return;
		$arrMatch = array('导演：'=>'director','主演：'=>'featured','地区：'=>'areas','年份：'=>'play_year','类型：'=>'category');
		$key = $value = $arrResult = NULL;
		if(isset($arrValue['span']) && is_array($arrValue['span'])) {
			$key   = $arrMatch[trim($arrValue['span']['cdata'])];
			$value = self::getCdataArray($arrValue['div']['a']);
		} elseif(isset($arrValue['cdata']) && isset($arrValue['a'])  && is_array($arrValue['a'])) {
			$key   = $arrMatch[trim($arrValue['cdata'])];
			$value = self::getCdataArray($arrValue['a']);
		} elseif(isset($arrValue['cdata']) && !isset($arrValue['a'])) {
			$key   = 'play_length';
			$value = str_replace(array('时长：','分钟'),'',$arrValue['cdata']);
		} elseif(is_string($arrValue)) {
			$key   = 'descs';
			$value = $arrValue;
		}
		if(!empty($key)) $arrResult = array($key,$value);
		return $arrResult;
	}

	public static function insertData($arrVideo, $arrUrl, $objRequest, $table, $cid) {
		if(empty($arrVideo['vid'])) {writeLog('#craw.youku.url.error.noVid.log','no vid:'. $arrUrl['url']);return;}
		$fileDirId = date("z");
		$year = date("Y");
		$objCrawlDao = new CrawlDao(__JULEV_DSN);
		$objCrawlDao -> setTable($table);
		if($table == 'video_tv' || $table == 'video_anime') {
			$objCrawlDao -> setTable($table);
			$series = $objCrawlDao -> getOne('title like "' . $arrVideo['tvName'] . '%" and video_from = "youku"', 'id');
			//$objRequest -> series = $series;
			if(empty($series)) {
				$objRequest -> index = "0";
			} else {
				$objRequest -> index = "1";
			}	
			$arrVideo['series'] = $series;
		}
		$arrDirectors = $arrVideo['director'];
		$arrVideo['director'] = !empty($arrVideo['director']) ? implode(' / ', $arrVideo['director']) : NULL;
		$arrFeatured  = $arrVideo['featured'];
		$arrVideo['featured'] = !empty($arrVideo['featured']) ? implode(' / ', $arrVideo['featured']) : NULL;
		$arrCategory  = $arrVideo['category'];
		$arrVideo['category'] = !empty($arrVideo['category']) ? implode(' / ', $arrVideo['category']) : NULL;
		$arrAreas  = $arrVideo['areas'];
		$arrVideo['areas'] = implode(' / ', $arrVideo['areas']);
		$arrVideo['video_from'] = 'youku';
		$arrVideo['cid'] = $cid;
		$arrVideo['play_year']  = $arrVideo['play_year'][0];
		$arrVideo['pic_local']  = $year . '/' . $fileDirId . '/';
		
		$id = $objCrawlDao -> insertIgnoreData($arrVideo);
		if($id > 0) {
			//search
			$arrVideoDataSearch['id'] = $id;
			$arrVideoDataSearch['title']= Searchkw::kw($arrVideo['title']);
			$arrVideoDataSearch['descs']= Searchkw::kw($arrVideo['descs']);
			$objCrawlDao -> setTable('video_search');
			$objCrawlDao -> insertData($arrVideoDataSearch);
			//
			if(!empty($arrCategory))
				foreach($arrCategory as $k => $v) {
					$v = trim($v);
					if(!empty($v)) {
						$v = trim(trim($v)) . '片';
						$objCrawlDao -> setTable('tag');
						$tid = $objCrawlDao -> getOne(array('tag'=>trim($v), 'tag_type'=>0), 'id');
						if(empty($tid)) {
							$tid = $objCrawlDao -> insertData(array('tag'=>trim($v), 'tag_type'=>'0'));
						}
						$objCrawlDao -> setTable('tag_video');
						$objCrawlDao -> insertIgnoreData(array('tid'=>$tid, 'video_id'=>$id));
					}
				}
			
			foreach($arrAreas as $k => $v) {
				$v = trim($v);
				if(!empty($v)) {
					$objCrawlDao -> setTable('tag');
					$tid = $objCrawlDao -> getOne(array('tag'=>trim($v), 'tag_type'=>0), 'id');
					if(empty($tid)) {
						$tid = $objCrawlDao -> insertData(array('tag'=>trim($v), 'tag_type'=>'0'));
					}
					$objCrawlDao -> setTable('tag_video');
					$objCrawlDao -> insertIgnoreData(array('tid'=>$tid, 'video_id'=>$id));
				}
			}
			//$director
			//$arrDirector = explode(' ', $director);
			if(!empty($arrDirectors)) {
				foreach($arrDirectors as $k => $v) {
					$v = trim($v);
					if(!empty($v)) {
						$objCrawlDao -> setTable('tag');
						$tid = $objCrawlDao -> getOne(array('tag'=>trim($v), 'tag_type'=>1), 'id');
						if(empty($tid)) {
							$tid = $objCrawlDao -> insertData(array('tag'=>trim($v), 'tag_type'=>'1'));
						}
						$objCrawlDao -> setTable('tag_video');
						$objCrawlDao -> insertIgnoreData(array('tid'=>$tid, 'video_id'=>$id));
					}
				}
			}
			
			//$arrFeatured = explode(' ', $featured);
			if(!empty($arrFeatured)) {
				foreach($arrFeatured as $k => $v) {
					$v = trim($v);
					if(!empty($v)) {
						$objCrawlDao -> setTable('tag');
						$tid = $objCrawlDao -> getOne(array('tag'=>trim($v), 'tag_type'=>'2'), 'id');
						if(empty($tid)) {
							$tid = $objCrawlDao -> insertData(array('tag'=>trim($v), 'tag_type'=>'2'));
						}
						$objCrawlDao -> setTable('tag_video');
						$objCrawlDao -> insertIgnoreData(array('tid'=>$tid, 'video_id'=>$id));
					}
				}
			}
			
			File::createDir(__DEFAULT_IMG . $year); 
			File::createDir(__DEFAULT_IMG . $year . '/' . $fileDirId);
			//File::createDir(__DEFAULT_IMG . $year . '/' . $fileDirId . '/' . $part);
			copy($arrVideo['pic'], __DEFAULT_IMG .  $year . '/' . $fileDirId . '/' . $id . '.jpg');
		}
	}

	public static function getCdataArray($arrCdata) {
		if(isset($arrCdata['cdata'])) return array($arrCdata['cdata']);
		$arrCdataArray = NULL;
		if(isset($arrCdata[0])) {
			foreach($arrCdata as $k => $v) {
				$arrCdataArray[$k] = $v['cdata'];
			}
		}
		return $arrCdataArray;
	}
}
?>