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


class MemberSitesDao extends DBQuery {
	public function __construct() {
		parent::__construct();
		$this -> pk = 'id';
	}
	
	public function getUserCorpInfo($arrCondition) {
		$this -> setTable('user_corp');
		return $this->getRow($arrCondition);
	}
}
?>