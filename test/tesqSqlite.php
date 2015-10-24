<?php 
/*
	auther: cooc 
	email:yemasky@msn.com
*/
require_once("etc/define.php");
$weibo_url = 'https://api.weibo.com/2/statuses/upload_url_text.json';
$source = '1693553059';
$status = 'test';
$visible = 1;
$url = 'http://www.julev.com/images/logo.gif';

$postdata = 'source=$source&status=$status&visible=$visible&url=$url';
$postdata = 'source=$source&status=%E6%9D%A5%E8%87%AAAPI%E6%B5%8B%E8%AF%95%E5%B7%A5%E5%85%B7&url=http%3A%2F%2Fwww.sinaimg.cn%2Fblog%2Fdeveloper%2Fwiki%2FLOGO_64x64.png&access_token=2.00HZJeLBvVybqBce0f9ec97cdUT3lB';
var_dump(GetContent::getCurl($weibo_url, NULL, NULL, $postdata));
return;
exit;

$startTime = getMicrotime();

        //$db = new SQLite("1.db");
		/*print_r($db->query("CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, country TEXT);"));
        print_r($db->query("delete from users where username = 'ciaos'"));
        // rows affected
        print_r($db->query("insert into users values(1, 'ciaos','pwd')"));
        // rows affected
        print_r($db->query("update users set username='ciaos2' where username='ciaos'"));
        // rows affected
        print_r($db->query('select * from users'));
		
		print_r($db->query('CREATE TABLE pic (id bigint(20) NOT NULL,cid mediumint(3) DEFAULT NULL,pic_bin longblob);'));
		print_r($db->query(' CREATE UNIQUE INDEX id_cid ON pic(id, cid);'));//logo.gif*/
		/*$pic_bin = addslashes(file_get_contents('images/logo.gif'));
		$stmt = $db->prepare("insert into pic values(1, 2, ?)");
		$stmt->bindValue("i", $pic_bin);*/
        // results array
		//$arrPic = $db->query('select * from pic');
		
		$db = new PDO("sqlite:1.db");
//获取文件2进制流 
//$filename = "d:/a.gif"; 
//$handle = fopen($filename, "r"); 
//$contents = fread($handle,filesize($filename)); 
//$contents = file_get_contents('images/logo.gif');
//fclose($handle); 
//创建数据表 
//$db->exec('CREATE TABLE person (idnum TEXT,name TEXT,photo BLOB)'); 
//$stmt = $db->prepare("INSERT INTO person VALUES ('222', '赵大',?)"); 
//$stmt->bindValue(1, $contents, PDO::PARAM_LOB); 
//$stmt->execute(); 


//从数据库中读取图片


//$result = $db->query("SELECT * FROM person WHERE idnum= '222'");
//获取第一行数据
//$row = $result->fetch();
//写出数据记录，首先查看是否存在记录
//if(!empty($row))
//{header("Content-type: image/JPEG",true);echo($row["photo"]);}
//显式的关闭PDO连接
$db = NULL;


$endTime = getMicrotime();
			$useTime = $endTime - $startTime;
			
			//echo $arrPic[0]['pic_bin'];
?>
