<?php 
/*
	auther: cooc 
	email:yemasky@msn.com
*/
require_once("../etc/define.php");

$model = 'IndexAction';
if(isset($_REQUEST['model'])) $model = $_REQUEST['model'];
$action = NULL;
if(isset($_REQUEST['action'])) $action = $_REQUEST['action'];

$arrActionRoute = array('validate'=>'Register','login'=>'Register');
if(isset($arrActionRoute[$model])) {$action = $model; $model = $arrActionRoute[$model];};
$model = ucwords($model) . 'Action';

try { 
	$objAction = new $model();
	$objAction -> execute($action);
} catch (Exception $e) {
	if(__Debug) {
		print_r($e -> getMessage());
		print_r($e -> getTraceAsString());
	}
	logError($e -> getMessage(), __MODEL_EXCEPTION);
	logError($e -> getTraceAsString(), __MODEL_EMPTY);
	$objAction = new NotFound();
	$objAction -> execute();
}
?>
