<?php
require_once "config.php";
require_once "user.php";
session_start();
class Message
{
	public static $answer = array();

	function get_by_id ($id) {
		$mysqli = Config::connect_db();
		$sql = "SELECT users.name, users.email, messages.header, messages.text, messages.date_created FROM messages LEFT JOIN users ON messages.user_id=users.user_id WHERE messages.message_id=" . $id;
		if ($mysqli->real_query($sql)) {
			if ($result = $mysqli->store_result()) {
				while ($row = $result->fetch_row()) {
					echo (json_encode(array($row)));
				}
				$result->free();
			}
		}
	}
	
	function approve_by_id ($id) {
		$mysqli = Config::connect_db();
		$sql = "UPDATE messages SET is_approved = true WHERE messages.message_id=" . $id;
		if ($mysqli->real_query($sql)) {
			echo (json_encode(1));
			}
	}
	
	function delete_by_id ($id) {
		$mysqli = Config::connect_db();
		$sql = "DELETE FROM messages WHERE messages.message_id=" . $id;
		if ($mysqli->real_query($sql)) {
			echo (json_encode(1));
		}
	}
	
	function get_approved ($start, $end) {
		$mysqli = Config::connect_db();
		$sql = "SELECT users.name, messages.header, messages.text, messages.date_created FROM messages LEFT JOIN users ON messages.user_id=users.user_id WHERE messages.is_approved=1 ORDER BY messages.date_created DESC LIMIT " . $start . "," . $end;
		if ($mysqli->real_query($sql)) {
			if ($result = $mysqli->store_result()) {
				self::$answer = array();
				while ($row = $result->fetch_row()) {
					self::$answer[] = $row;
				}
				echo (json_encode(self::$answer));
				$result->free();
			}
		}
	}
	
	function get_total ($start, $end) {
		$mysqli = Config::connect_db();
		$sql = "SELECT messages.message_id, messages.header, messages.text, messages.is_approved FROM messages LIMIT " . $start . "," . $end;
		if ($mysqli->real_query($sql)) {
			if ($result = $mysqli->store_result()) {
				self::$answer = array();
				while ($row = $result->fetch_row()) {
					self::$answer[] = $row;
				}
				echo (json_encode(self::$answer));
				$result->free();
			}
		}
	}

	function validate_text($text) {
		$text = strip_tags($text);
		$text = htmlspecialchars($text);
		$text = mysql_escape_string($text);
		return $text;
	}

	function add($user_id, $header, $text) {
		$mysqli = Config::connect_db();
		$header = self::validate_text($header);
		$text = self::validate_text($text);
		if (($header=='') || ($text=='')) {
			echo ("invalid data");
		} else {
			$sql = "INSERT INTO messages (user_id, header, text, is_approved, date_created) VALUES('". $user_id . "','" . $header . "','" . $text . "','0', CURRENT_TIMESTAMP)";
			if ($mysqli->real_query($sql)) {
				echo ("success");
			} else {
				echo ("transaction failed");
			}
		}
	}
}

if (isset($_POST['get_approved'])) {
	Message::get_approved($_POST['start'],$_POST['end']);
}

if (isset($_POST['get_total'])) {
	Message::get_total($_POST['start'],$_POST['end']);
}

if (isset($_POST['get_by_id'])) {
	Message::get_by_id($_POST['get_by_id']);
}

if (isset($_POST['approve_by_id'])) {
	Message::approve_by_id($_POST['approve_by_id']);
}

if (isset($_POST['delete_by_id'])) {
	Message::delete_by_id($_POST['delete_by_id']);
}

if (isset($_POST['add'])) {
	$name = Message::validate_text($_POST['name']);
	if ($name == '') {
		echo ("invalid name");
	} else {
		$email = $_POST['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo ("invalid email");
		} else {
			$user = User::get_by_email($email);
			if ($user) {
				Message::add($user[0],$_POST['header'],$_POST['text']);
			} else {
				$user = User::add($_POST['name'],$email);
				if ($user) {
					Message::add($user,$_POST['header'],$_POST['text']);
				} else {
					echo ("transaction failed");
				}
			}
		}
	}
}
?>