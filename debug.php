<?php
	function asd($stuff) {
		$file_location = 'logger.txt';
		$output = 'DEBUG: '.date('Y-m-d h:i:s').PHP_EOL;
		$backtrace = debug_backtrace();
		if (isset($backtrace[1])) $output .= print_r($backtrace[1]['class'].' :: '.$backtrace[1]['function'], true).PHP_EOL;
		$output .= print_r($stuff, true);
		$output .= PHP_EOL;
		$file = fopen($file_location, 'a');
		fwrite($file, $output);
		fclose($file);
	}
?>