<?php
	class hAdapter {
		public static function adaptEach($adapters, $items) {
			$output = array();
			foreach($items as $item) {
				$output[] = self::adapt($adapters, $item);
			}
			return $output;
		}
		public static function adapt($adapters, $content) {
			$output = array();
			foreach($adapters as $adapter) {
				$target = $adapter['target'];
				$source_content = self::getSourceContent($adapter, $content);
				hPathFollower::setValue($target, $output, $source_content);
			}
			return $output;
		}
		public static function getSourceContent($adapter, $content) {
			$output = false;
			if (isset($adapter['source'])) {
				$source = $adapter['source'];
				$output = hPathFollower::followPathSlash($source, $content);
			} else if (isset($adapter['static'])) {
				$output = $adapter['static'];
			}
			return $output;
		}
	}
?>