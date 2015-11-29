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


class ManageDao extends DBQuery {
	public function __construct() {
		parent::__construct();
		$this -> pk = 'id';
	}
	
	public function example($arrCondition) {
		$this -> setTable('example');
		return $this->getRow($arrCondition);
	}
}
?>