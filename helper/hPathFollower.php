<?php
	class hPathFollower {
		public static function followPathSlash($path, $arr) {
			$elements = explode('/', $path);
			return self::followPathArr($elements, $arr);
		}
		public static function followPathArr($path_elements, $arr) {
			$output = false;
			if (is_array($path_elements) && is_array($arr)) {
				$current_location = $arr;
				foreach($path_elements as $path_node) {
					if (isset($current_location[$path_node])) {
						$current_location = $current_location[$path_node];
					} else {
						$current_location = false;
						break;
					}
				}
				$output = $current_location;
			}
			return $output;
		}
	}
?>