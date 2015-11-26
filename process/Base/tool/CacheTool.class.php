<?php
/**
 * PHP versions 5
 * @author     cooc <yemasky@msn.com>
 */
class CacheTool {
	public static function createUserCache($filename, $arrValue, $uid) {
		$arrValue = Utilities::addslashesStr($arrValue);
		$contant = "<?php\r\n".'$rs'." = ".Utilities::arrayTurnStr($arrValue).";\r\n?>";
		File::creatFile($filename .'.php', $contant, PathManager::createUserDir($uid));
	}
	
	public static function createUserInfoCache($arrValue, $uid) {
		self::createUserCache('userinfo', $arrValue, $uid);
	}

}
?>