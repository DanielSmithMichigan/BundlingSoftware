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
		public static function roundAndSquare($numbers, $on, $final) {
			$largest_key = false;
			$largest_amount = false;
			$sum = 0;
			
			foreach($numbers as $number_key => &$number) {
				if ($largest_amount === false || $number[$on] > $largest_amount) {
					$largest_key = $number_key;
					$largest_amount = $number[$on];
				}
				$number[$on] = round($number[$on], 2);
			}
			
			unset($number);
			
			foreach($numbers as $number_key => $number) {
				if ($number_key !== $largest_key) {
					$sum += $number[$on];
				}
			}
			
			$numbers[$largest_key][$on] = $final - $sum;
			
			return $numbers;
		}
	}
?>