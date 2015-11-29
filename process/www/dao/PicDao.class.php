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


class PicDao extends DBQuery {
	public function __construct($dsn = __DEFAULT_DSN) {
		parent::__construct($dsn);
	}
		
	public function getPic($conditions = NULL, $sort = NULL, $fields = NULL, $limit = 1) {
		return $this -> getList($conditions, $sort, $fields, $limit);
	}	
}
?>