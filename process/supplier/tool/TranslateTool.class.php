<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/17
 * Time: 10:40
 */

namespace supplier;


class TranslateTool {
    public function translatePlace() {
        set_time_limit(0);
        $conditions = \DbConfig::$db_query_conditions;
        $fileid = 'c_id, c_name';
        $conditions['where'] = "c_name_cn != ''";
        $arrayPlace = \BasePlaceDao::getPlace($conditions, $fileid);
        $num = count($arrayPlace);
        for($i = 0; $i < $num; $i++) {
            if($i % 10 == 9) sleep(10);
            //echo $i % 10 . "\r\n<br>";
            $cn_translate = \Translate::exec($arrayPlace[$i]['c_name']);
            \BasePlaceDao::updatePlaceCnName(array('c_id'=>$arrayPlace[$i]['c_id']), array('c_name_cn'=>addslashes($cn_translate)));
            echo $arrayPlace[$i]['c_name'] . '-->' . $cn_translate . "\r\n<br>";
            flush();
            ob_flush();


        }
    }
}