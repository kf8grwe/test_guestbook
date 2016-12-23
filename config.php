<?php
class Config {
	private static $db_host = '';
	private static $db_name = '';
	private static $db_user = '';
	private static $db_password = '';
	
	public static function connect_db() {
		$mysqli = new mysqli(Config::$db_host,Config::$db_user,Config::$db_password,Config::$db_name);
		if (mysqli_connect_errno()) {
			printf("Не удалось подключиться: %s\n", mysqli_connect_error());
			exit();
		} else {
			return $mysqli;	
		}
	}
}
?>