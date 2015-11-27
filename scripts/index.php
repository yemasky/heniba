<?php 
/*
	auther: cooc 
	email:yemasky@msn.com
*/

try {
	require_once("../etc/define.php");
	$model = 'IndexAction';
	if (isset($_REQUEST['model'])) $model = ucwords($_REQUEST['model']) . 'Action';
	$action = NULL;
	if (isset($_REQUEST['action'])) $action = $_REQUEST['action'];
} catch (Exception $e) {
	print_r($e -> getMessage());
	print_r($e -> getTraceAsString());
}

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