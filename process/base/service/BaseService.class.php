<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 10:58
 */
abstract class BaseService
{
    protected $objProcess = '';
    public function __construct($objProcess = NULL){
        if(is_array($objProcess)) {
            $this->objProcess = $objProcess[0];
        } elseif(is_object($objProcess)) {
            $this->objProcess = $objProcess;
        }
    }
}