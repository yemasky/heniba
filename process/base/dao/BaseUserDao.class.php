<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/10
 * Time: 13:13
 */
class BaseUserDao extends BaseDao{
    protected $table = 'user';
    protected $dsn_read = DbConfig::tourism_dsn_read;
    protected $dsn_write = DbConfig::tourism_dsn_write;
    protected $table_key = 'u_id';
    protected $fields = '';
    public static function instance() {
        if(is_object(self::$objSelfDao)) return self::$objSelfDao;
        self::$objSelfDao = new BaseOrderDao();
        return self::$objSelfDao;
    }


}