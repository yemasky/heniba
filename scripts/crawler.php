<?php 
/*
	auther: cooc 
	email:yemasky@msn.com
*/
require_once("./etc/define.php");

if(isset($_SERVER['argc']) && $_SERVER['argc']==2) { 
	$arrVariables = explode('&', $argv[1]);
	$arrParameter = NULL;
	if(!empty($arrVariables[0])) {
		foreach($arrVariables as $k => $v) {
			$arrVariable = explode('=', $v);
			if(!isset($arrVariable[1])) $arrVariable[1] = NULL;
			$arrParameter[$arrVariable[0]] = $arrVariable[1];
		}
	}
	$_GET = $arrParameter;
}  else {
	//exit;
}
$arrRoute = array('default'=>'Homepage','crawler'=>'Crawler');
$model = '';
if(isset($_GET['model'])) $model = $_GET['model'];
$model = isset($arrRoute[$model]) ? $arrRoute[$model] . 'Action' : 'CrawlerAction';

$objAction = new $model();

$objAction -> execute();

?>
