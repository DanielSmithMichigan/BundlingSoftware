<?php
	class bMenu {
		public function __construct () {
		}
		public function getMenu() {
			$sql = ' select ';
			$bind_param = new hBindParam();
			
			$sql .= ' menu.menu_item_display, menu.menu_item_name, menu.glyphicon from menu
			where 1 = 1 ';
			
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			return $results;
		}
	}
?>