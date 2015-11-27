<?php
if( !defined('DEFINE_PHP') ){
define('DEFINE_PHP','YES');

///close web
define('__CLOSE_WEB', false);
//web  
define('__WEB_KEY','localhost');
define('__KEY','xyzABcdeee12345');
define('__WEB','http://localhost/heniba/scripts/');
define('__RESOURCE','http://localhost/heniba/scripts/resource/');
define('__BBS','http://localhost/izhizu/www/bbs/');
define('__PIC','http://localhost/izhizu/www/');

/// physical path ///
define('__ROOT_PATH',substr(dirname(__FILE__), 0, -3));
define('__ROOT_TPLS_TPATH',__ROOT_PATH.'templates/');
define('__ROOT_TEMPLATES_TPATH', __ROOT_TPLS_TPATH);

//data path, web url 
define('__DATA_PATH', __ROOT_PATH);
define('__DATA', __DATA_PATH.'data/');
define('__SQLITE_DATA', __DATA_PATH.'data/sqlite/');

define('__HTML', __DATA_PATH.'static/');
define('__HTML_WEB', 'http://localhost/izhizu/www/static/');

//images
define('__DEFAULT_PATH',__ROOT_PATH);
define('__DEFAULT_IMG',__DEFAULT_PATH.'data/images/');
define('__IMGWEB','http://localhost/heniba/scripts/data/images/');

define('__XML_PATH',__ROOT_PATH);
define('__XML',__XML_PATH.'data/xml/');
define('__XMLWEB','http://xml.yelove.cn/data/xml/');

define('__USER_DATA_PATH',__ROOT_PATH);
define('__USER_DATA',__USER_DATA_PATH.'data/userdata/');
define('__USER_IMG',__USER_DATA_PATH.'data/userimg/');
define('__USER_IMGWEB','http://localhost/izhizu/www/data/userimg/');//

/// cache physical path ///
define('__CACHE',__ROOT_PATH.'etc/cache/');
define('__CACHE_FILE',__CACHE.'filecache/');
define('__USER_CACHE',__CACHE.'user/');
define('__ROOT_LOGS_PATH',__CACHE.'logs/');
define('__CRAWL',__CACHE . 'crawl/');
define('__CACHE_TIME', '7200');
define('__ETAG', false);

// style
define('__DEFAULT_STYLE', 'default/');
define('__COMPILE', true);

/// db connection ///
define('__DEFAULT_DSN','mysql://root:root@127.0.0.1/julev_com'); 
define('__JULEV_PIC_DSN','mysql://root:root@127.0.0.1/julev_com_pic');  
define('__BBS_DSN','mysql://root:root@127.0.0.1/yelove_bbs');    
define('__bbs_tablepre', 'yelove_');

// web charset, language
define('__CHARSET','utf-8');
define('__LANGUAGE','zh-CN');

//debug
define('__Debug',true);

require_once(__ROOT_PATH . "/libs/Core/func.Common.php");
require_once(__ROOT_PATH . "/libs/Core/BaseAction.class.php");
}
?>