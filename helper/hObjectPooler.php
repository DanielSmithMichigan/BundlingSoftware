<?php
	class hObjectPooler {
		public static $objects = array();
		public static function getObject($object_name) {
			if (!isset(self::$objects[$object_name])) {
				self::$objects[$object_name] = new $object_name();
			}
			return self::$objects[$object_name];
		}
	
	}
?>