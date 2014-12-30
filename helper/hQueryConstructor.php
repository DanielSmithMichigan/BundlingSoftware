<?php 
	class hQueryConstructor {
		public static $sql_data;
		public static $sql;
		public static function setSql($sql) {
			self::$sql = $sql;
		}
		public static function setSqlData($sql_data) {
			self::$sql_data = $sql_data;
		}
		public static function getSql() {
			return self::$sql;
		}
		public static function getSqlData() {
			return self::$sql_data;
		}
		public static function executeStatement($sql, $bind_param) {
			$output = array();
			$connection = bDatabase::$conn;
			$query = $connection->prepare($sql);
			if ($query === false) {
				$output = false;
				asd($connection->error);
				asd($sql);
			} else {
				if ($bind_param->hasBindings()) {
					call_user_func_array(array($query, 'bind_param'), $bind_param->get());
				}
				$query->execute();
				$results = $query -> get_result();
				while ($row = $results -> fetch_assoc()) {
					$output[] = $row;
				}
			}
			return $output;
		}
		public static function getCleanOutput($var) {
			$var = mysqli_real_escape_string(bDatabase::$conn, $var);
			return " '".$var."' ";
		}
		public static function addVarChar($string) {
			$output = self::beginParameter($string);
			$output['type'] = 's';
			return $output;
		}
		public static function addNumber($number) {
			$output = self::beginParameter($number);
			$output['type'] = 'i';
			return $output;
		}
		public static function beginParameter($var) {
			$output = array();
			$output['data'] = $var;
			return $output;
		}
	}
?>