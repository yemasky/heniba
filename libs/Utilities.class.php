<?php
/*
	class.Utilities.php
	auther: 罗驰 
	email:yemasky@msn.com
*/

class Utilities {

	public static function &arrayTurnStr($data) {
		$str = '';
		if(is_array($data)) {
			$str .= "array(";
			foreach($data as $k => $v) {
				if(is_array($v)) {
					$str .= "'$k' => ";
					$str .= self::arrayTurnStr($v).',';
				} else {
					$str .= "'$k' => '$v',";
				}
			}
			$str = trim($str, ',').")";
		}
		return $str;
	}
	
	public static function &addslashesStr($data) {
		if(is_array($data)) {
			foreach($data as $key => $val) {
				if(is_array($val)) {
					$data[$key] = self::addslashesStr($val);
				} else {
					$data[$key] = addslashes($val);
				}
			}
		} else {
			$data = addslashes($data);
		}
		return $data;
	}

	public static function &toHtml($data) {
		if(is_array($data)) {
			foreach($data as $key => $val) {
				if(is_array($val)) {
					$data[$key] = self::toHtml($val);
				} else {
					$data[$key] = nl2br(str_replace(" ", "&nbsp;", htmlspecialchars($val)));
				}
			}
		} else {
			$data = nl2br(str_replace(" ", "&nbsp;", htmlspecialchars($data)));
		}
		return $data;
	}
	
	public static function formatXmlSpecialChar($str) {
		return str_replace("'",'&apos;',str_replace('"','&quot;',str_replace('<','&lt;',str_replace('>','&gt;',str_replace('&','&amp;',$str)))));
	}
}
?>