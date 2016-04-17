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
        $conditions['where'] = "c_name_cn IS NULL";
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

    public function translateTourism() {
        set_time_limit(0);
        $conditions = \DbConfig::$db_query_conditions;
        $fileid = 't_id, t_title, t_title_cn';
        $conditions['where'] = "t_title_cn IS NULL OR t_title_cn = ''";
        $arrayResult = \BaseTourismDao::instance()->getTourism($conditions, $fileid);
        $num = count($arrayResult);
        for($i = 0; $i < $num; $i++) {
            if($i % 10 == 9) sleep(10);
            //echo $i % 10 . "\r\n<br>";
            $cn_translate = \Translate::exec($arrayResult[$i]['t_title']);
            \BaseTourismDao::instance()->updateTourism(array('t_id'=>$arrayResult[$i]['t_id']), array('t_title_cn'=>addslashes($cn_translate)));
            echo $arrayResult[$i]['t_title'] . '-->' . iconv('UTF-8', 'GBK', $cn_translate) . "\r\n<br>";
            flush();
            ob_flush();
        }
    }

    public function translateBemyguest() {
        set_time_limit(0);
        $conditions = \DbConfig::$db_query_conditions;
        $fileid = 'id, title, titleTranslated, description, descriptionTranslated';
        //$conditions['where'] = "t_title_cn IS NULL OR t_title_cn = ''";
        $objBemyguestDao = new BemyguestDao();
        $arrayResult = $objBemyguestDao->getBemyguestTour($conditions, $fileid);
        $num = count($arrayResult);
        for($i = 0; $i < $num; $i++) {
            if($i % 10 == 9) sleep(10);
            //echo $i % 10 . "\r\n<br>";
            if (preg_match("/^[\x{4e00}-\x{9fa5}]+$/u", $arrayResult[$i]['titleTranslated'])) {
            } else {
                $cn_translate = \Translate::exec($arrayResult[$i]['title']);
                $cn_translate_description = \Translate::exec($arrayResult[$i]['description']);
                $objBemyguestDao->updateBemyguestTour(array('id' => $arrayResult[$i]['id']), array('titleTranslated' => addslashes($cn_translate), 'descriptionTranslated' => addslashes($cn_translate_description)));
                echo $arrayResult[$i]['title'] . '-->' . iconv('UTF-8', 'GBK', $cn_translate) . "\r\n<br>";
                flush();
                ob_flush();
            }
        }
    }
}