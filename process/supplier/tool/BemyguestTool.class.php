<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/8
 * Time: 10:37
 */
class BemyguestTool extends BaseTool
{
    public function insertToTourism() {
        $bemyguestData = $this->objProcess->BemyguestDao->selectTourAsTourism();
    }
}