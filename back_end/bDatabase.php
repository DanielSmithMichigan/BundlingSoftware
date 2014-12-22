<?php
	class bDatabase {
		public static $conn;
		public static function connect() {
			$servername = "localhost";
			$username = "sys1";
			$password = "8rpr9pWf2vA3P9pX";
			$database_name = 'aaa_bundling_software';
			self::$conn = mysqli_connect($servername, $username, $password);
			mysqli_select_db(self::$conn, $database_name);
		}
		public static function disconnect() {
			self::$conn->close();
		}
	}
?>