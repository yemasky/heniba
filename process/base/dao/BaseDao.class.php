<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/9
 * Time: 18:04
 */
abstract class BaseDao{
    protected $objProcess = '';

    public function __construct($objProcess = NULL){
        if(is_array($objProcess) && !empty($objProcess)) {
            $this->objProcess = $objProcess[0];
        } elseif(is_object($objProcess)) {
            $this->objProcess = $objProcess;
        }
    }

    /**
     * 魔术函数，执行模型扩展类的自动加载及使用
     */
    public function __call($name, $args){
        $objCallName = new $name($args);
        $objCallName->setCallObj($this, $args);
        return $objCallName;
    }

}