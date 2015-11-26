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


class FetchDataDao extends DBQuery {
	public function __construct() {
		parent::__construct();
		//$this -> pk = 'id';
		//$this -> setTable('user_info');
	}
	
	public function FetchData($arrayData) {
		$this -> pk = $arrayData['master']['pk'];
		$this -> setTable($arrayData['master']['table']);
		//return $this->getRow($arrCondition);
	}
}
?>