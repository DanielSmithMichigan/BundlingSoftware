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
				$source = $adapter['source'];
				$target = $adapter['target'];
				$source_content = hPathFollower::followPathSlash($source, $content);
				hPathFollower::setValue($target, $output, $source_content);
			}
			return $output;
		}
	}
?>