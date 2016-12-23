<?php
require_once "config.php";
require_once "message.php";
class User 
{
	public static function get_by_email ($email) {
		$mysqli = Config::connect_db();
		$sql = "SELECT users.user_id, users.name, users.email FROM users WHERE users.email='" . $email . "'";
		if ($mysqli->real_query($sql)) {
			if ($result = $mysqli->store_result()) {
				$row = $result->fetch_row();
				$result->free();
				return $row;
			} else {
				return false;
			}
		}
	}
	
	public static function add($name, $email) {
		filter_var($email, FILTER_VALIDATE_EMAIL);
		$mysqli = Config::connect_db();
		$sql = "INSERT INTO users (name, email) VALUES('". $name . "','" . $email . "')";
		$mysqli->real_query($sql);
		if ($mysqli->insert_id) {
			return $mysqli->insert_id;
		} else {
			return false;
		}
	}
}
?>