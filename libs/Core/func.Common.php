<?php
/*
	func.Common.php
	auther: cooc 
	email:yemasky@msn.com
*/
if(!defined("INC_FUNC_COMMON")) {
 	define("INC_FUNC_COMMON", "1");
	
define("__MODEL_EMPTY", "");
define("__MODEL_EXCEPTION", "Exception");

date_default_timezone_set('PRC');

function __autoload($class) {
	$len = strlen($class)-1;
	for($loop = $len; $loop>=0; $loop--) {
		if($class[$loop] >= 'A' && $class[$loop] <= 'Z') {
			break;
		}
	}
	$classpath = __ROOT_PATH; 
	$execute_dir = '';
	switch(substr($class, $loop)) {
		case "Action":
			$execute_dir =  "process/action/";
		break;
		case "Dao":
			$execute_dir = "process/dao/";
		break;
		case "Comm":
			$execute_dir = "process/comm/";
		break;
		case "Tool":
			$execute_dir = "process/tool/";
		break;
		default:
			$execute_dir = 'libs/';
		break;
	}
	$classes_file = $classpath . $execute_dir . $class . ".class.php";

	if(file_exists($classes_file)) {
		include_once($classes_file);
	} else {
		throw new Exception("unable to load class: $class");
		//trigger_error("unable to load class: $class", E_USER_ERROR);
		//class $class extends BaseAction; //{
		//}
	}
	
}

function getDateTime($d = 0) {
	return date("Y-m-d H:i:s", strtotime("$d HOUR"));//GMT+8
}

function getHis() {
	return date("His");
}

function getDateTimeId($l = 6, $d = 8) {
	$time = date("YmdHis", strtotime("+$d HOUR"));//GMT+8
	$time .= trim(substr(microtime(), 2, $l));
	return $time;
}

function logError($message, $model="", $level="ERROR") {
	writeLog("#error.log", $message);
}

function logDebug($message, $model="", $level="DEBUG") {
	writeLog("#debug.log", $message);
}

function writeLog($filename, $msg) {
	$fp = fopen(__ROOT_LOGS_PATH.$filename, "a+");
	$uri = '';
	if(isset($_SERVER['REQUEST_URI'])) $uri = $_SERVER['REQUEST_URI'];
	$msg = getDateTime() . " >>> " . $uri . ' >> ' . $msg;
	fwrite($fp, "$msg\r\n");
	fclose($fp);
}

function redirect($url, $status = '302', $time = 0) {
	if(is_numeric($url)) {
		header("Content-type: text/html; charset=".__CHARSET);
		echo "<script>history.go('$url')</script>";
		flush();
	} else {
		if($time > 0) {
			echo "<meta http-equiv=refresh content=\"$time; url=$url\">"; 
			exit;	
		}
		if(headers_sent()) {
			echo "<meta http-equiv=refresh content=\"0; url=$url\">"; 
			echo "<script type='text/javascript'>location.href='$url';</script>";
		} else {
			if($status == '302') {
				header("HTTP/1.1 302 Moved Temporarily");
				header("Location: $url");
				exit;
			}
			header("Cache-Control: no-cache, must-revalidate"); 
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: $url");
		}
	}
	exit;
}

function checkNum($id) {
	if(!is_numeric($id)) {
		throw new Exception("parameter error: no the num -> ".$id);
	}
}

/*function keyED($string, $key) {
	$key_length = strlen($key);
	$string_length = strlen($string);

	$rndkey = $box = array();
	$result = '';

	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($key[$i % $key_length]);
		$box[$i] = $i;
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	return $result;
}

function encode($string, $key = __WEB) {
	$key = md5($key.__KEY);
	$string = substr(md5($string.$key), 0, 8).$string;
	return str_replace('+', ' ', base64_encode(keyED($string, $key)));
}

function decode($string, $key = __WEB) {
	$key = md5($key.__KEY);
	$result = keyED(base64_decode(str_replace(' ', '+', $string)), $key);
	if(substr($result, 0, 8) == substr(md5(substr($result, 8).$key), 0, 8)) {
		return substr($result, 8);
	} else {
		return NULL;
	}
}*/
function keyED($txt, $encrypt_key) {
	$encrypt_key = md5($encrypt_key);
	$ctr=0;
	$tmp = "";
	for ($i=0;$i<strlen($txt);$i++)	{
		if ($ctr==strlen($encrypt_key)) $ctr=0;
		$tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1);
		$ctr++;
	}
	return $tmp;
}

function encode($txt, $key = __WEB) {
	srand((double)microtime()*1000000);
	$encrypt_key = md5(rand(0,32000));
	$ctr=0;
	$tmp = "";
	for ($i=0;$i<strlen($txt);$i++)	{
		if ($ctr==strlen($encrypt_key)) $ctr=0;
		$tmp.= substr($encrypt_key,$ctr,1) . (substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
		$ctr++;
	}
	return str_replace('+', ' ', base64_encode(keyED($tmp,$key)));
}

function decode($txt, $key = __WEB) {
	$txt = keyED(base64_decode(str_replace(' ', '+', $txt)), $key);
	$tmp = "";
	for ($i=0;$i<strlen($txt);$i++)	{
		$md5 = substr($txt,$i,1);
		$i++;
		$tmp.= (substr($txt,$i,1) ^ $md5);
	}
	return $tmp;
}

function errorLog($msg) {
	logError("[err]$msg;request ip:".onLineIp().";url:".getUrl().";ReferUrl:".getReferUrl().";time:".getDateTime());
	//throw new Exception("[err]$msg;request ip:".onLineIp().";url:".getUrl().";ReferUrl:".getReferUrl().";time:".getDateTime());
}
function getMicrotime(){ 
	list($usec, $sec) = explode(" ",microtime()); 
	return ((float)$usec + (float)$sec); 
} 

function onLineIp() {
	if(isset($_SERVER['HTTP_CLIENT_IP'])) {
		 $onlineip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		 $onlineip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		 $onlineip = $_SERVER['REMOTE_ADDR'];
	}
	return $onlineip;
}
function getHost() {
	return $_SERVER['HTTP_HOST'];   
}
function getUrl() {
	if($_SERVER["SERVER_PORT"] == 80) {
		return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
	}
	return 'http://'.$_SERVER['HTTP_HOST'].":".$_SERVER["SERVER_PORT"].$_SERVER['REQUEST_URI'];   
}
function getReferUrl() {
	if(!isset($_SERVER['HTTP_REFERER'])) return NULL;
	if(($url = $_SERVER['HTTP_REFERER']) == NULL) {
		return '/';
	}
	return $url;
}

function conutf8($v, $e = 'GBK', $c = 'UTF-8') {
	return iconv($e, $c, $v);
}
function alert($mess, $go = -1) {
	if(!headers_sent()) {
		header("Content-type: text/html; charset=".__CHARSET);
	}
	$script = $go == 0 ? "" : "history.go(".$go.");";
	echo "<script>alert('".$mess."');$script</script>";
	flush();
	if(!empty($script)) {exit;}
}

function exception_handler($exception) {
	//echo "Uncaught exception: " , $exception->getMessage(), "\n";
	if(__Debug) {
		print_r($e -> getMessage());
		print_r($e -> getTraceAsString());
	}
	logError($e -> getMessage(), __MODEL_EXCEPTION);
	logError($e -> getTraceAsString(), __MODEL_EMPTY);
}

function ErrorHandler($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {// This error code is not included in error_reporting
        return;
    }
	$msg = '';
    switch ($errno) {
		case E_USER_ERROR:
			$msg .= "ERROR [$errno] $errstr ;";
			$msg .= "  Fatal error on line $errline in file $errfile";
			$msg .= ", PHP " . PHP_VERSION . " (" . PHP_OS . ") ;";
			//$msg .= "Aborting..;";
			//exit(1);
			break;
	
		case E_USER_WARNING:
			$msg .= "WARNING [$errno] $errstr on line $errline in file $errfile;";
			break;
	
		case E_USER_NOTICE:
			$msg .= "NOTICE [$errno] $errstr on line $errline in file $errfile;";
			break;
	
		default:
			$msg .= "Unknown error type: [$errno] $errstr on line $errline in file $errfile;";
			break;
    }
	if(__Debug) {
		print_r($msg);
	}
	writeLog('errorHandler.'.date("z").'.log', $msg);
    /* Don't execute PHP internal error handler */
    return true;
}
function cutString($str, $len, $start = 0) {
	if(strlen($str) <= $len) {
		return $str;
	}
	for($loop=0; $loop<$len; $loop++) {
		if(ord($str[$loop]) > 224) {
			$loop += 2;
			continue;
		}
		if(ord($str[$loop]) > 192) {
			$loop++;
		}
	}
	/*if($loop == $len + 1) {
		$len--;
	}*/
	return substr($str, 0, $loop);
}
function getModelByUri() {
	$model = 'index';//REDIRECT_URL 
	if(isset($_SERVER['REDIRECT_URL'])) {
		$arrScript = explode('/', substr($_SERVER['REDIRECT_URL'], 0, -5));
		$model = $arrScript[count($arrScript) - 1];
	} elseif(isset($_SERVER['REQUEST_URI'])) {
		$arrScript = explode('?', substr($_SERVER['REQUEST_URI']));
		$script = $arrScript[0];
		$arrScript = explode('/', substr($script, 0, -5));
		$model = $arrScript[count($arrScript) - 1];
	}
	return $model;
}
//排序
function cmp_func($arrSort, $arrOrder) {
	global $order;
	if ($arrSort['is_dir'] && !$arrOrder['is_dir']) {
		return -1;
	} else if (!$arrSort['is_dir'] && $arrOrder['is_dir']) {
		return 1;
	} else {
		if ($order == 'size') {
			if ($arrSort['filesize'] > $arrOrder['filesize']) {
				return 1;
			} else if ($arrSort['filesize'] < $arrOrder['filesize']) {
				return -1;
			} else {
				return 0;
			}
		} else if ($order == 'type') {
			return strcmp($arrSort['filetype'], $arrOrder['filetype']);
		} else {
			return strcmp($arrSort['filename'], $arrOrder['filename']);
		}
	}
}
}
?>
