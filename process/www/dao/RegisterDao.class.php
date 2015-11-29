<?php


/**
 *-------------------------
 *
 *
 * PHP versions 5
 *
 *
 * @author     cooc <yemasky@msn.com>
 */


class RegisterDao extends DBQuery {
	public function __construct() {
		parent::__construct();
		$this -> pk = 'uid';
		$this -> setTable('user_login');
	}
	
}
?>