<?php
	class hConfig {
		public static $configuration = array();
		public static function getConfiguration() {
			$config_file_location = 'config.txt';
			$file = file_get_contents($config_file_location);
			$lines = explode(';', $file);
			foreach($lines as $line) {
				$line = trim($line);
				$line_setting_split = explode('=', $line);
				$line_var_name = $line_setting_split[0];
				$line_var_value = $line_setting_split[1];
				$line_var_split = explode(',', $line_var_value);
				if(count($line_var_split) > 1) {
					$line_var_value = $line_var_split;
				}
				self::$configuration[$line_var_name] = $line_var_value;
			}
		}
		public static function getSetting($setting_name, $force_array = false) {
			$output = false;
			if (isset(self::$configuration[$setting_name])) {
				$output = self::$configuration[$setting_name];
			}
			if ($force_array === true) {
				if (!is_array($output)) {
					$output = array($output);
				}
			}
			return $output;
		}
		public static function getSettingPair($setting_1_name, $setting_2_name) {
			$setting_1 = self::getSetting($setting_1_name);
			$setting_2 = self::getSetting($setting_2_name);
			$output = hGeneral::mapOneToOne($setting_1, $setting_2);
			return $output;
		}
	}
?>