<?php 
/*
	auther: cooc 
	email:yemasky@msn.com
*/
require_once("./etc/define.php");

$action = NULL;
if(isset($_REQUEST['action'])) $action = $_REQUEST['action'];

$objAction = new ManageAction();

$objAction -> execute($action);

?>
