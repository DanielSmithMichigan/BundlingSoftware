<?php
	function __autoload($class_name) {
		$first_char = substr($class_name, 0, 1);
		$folder_location = array(
			'b' => 'back_end'
			,'f' => 'front_end'
			,'h' => 'helper'
			,'d' => 'display'
		);
		$folder = $folder_location[$first_char];
		$file_location = $folder.'/'.$class_name . '.php';
		if (file_exists($file_location)) {
			require($file_location);
			return true;
		}
	}
?>