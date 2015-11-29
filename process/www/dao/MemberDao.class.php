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


class MemberDao extends DBQuery {
	public function __construct() {
		parent::__construct();
		$this -> pk = 'uid';
		$this -> setTable('user_info');
	}
	
	public function getUserInfo($arrCondition) {
		return $this->getRow($arrCondition);
	}
}
?>