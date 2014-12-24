<?php
	class hCache {
		public static $database = array();
		public static function getValueFromInternal($path) {
			return hPathFollower::followPathSlash($path, self::$database);
		}
		public static function setValueInternal($path, $value) {
			hPathFollower::setValue($path, self::$database, $value);
		}
		public static function getValueFromSession($path) {
			if (!isset($_SESSION['cache'])) {
				$_SESSION['cache'] = array();
			}
			return hPathFollower::followPathSlash($path, $_SESSION['cache']);
		}
	}
?>