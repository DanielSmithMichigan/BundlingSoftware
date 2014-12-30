<?php
	class hGeneral {
		public static function defaultToArray($var) {
			$output = array();
			if ($var !== false) {
				$output = $var;
			}
			return $output;
		}
		public static function isParameterArray($var) {
			$output = false;
			if (isset($var) && is_array($var)) {
				$output = true;
			}
			return $output;
		}
		public static function mapOneToOne($arr1, $arr2) {
			$output = array();
			while(is_array($arr1) && is_array($arr2) && count($arr1)) {
				$output[array_shift($arr1)] = array_shift($arr2);
			}
			return $output;
		}
	}
?>