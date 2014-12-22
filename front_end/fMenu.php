<?php
	class fMenu {
		public function getAndDisplayMenu($type = null) {
			$menu_data = $this->getMenu();
			$permissions_obj = hObjectPooler::getObject('bPermission');
			$menu_data = $permissions_obj->filterOnArrayPath($menu_data, 'menu_item_name', 'menu/');
			$this->displayMenu($menu_data, $type);
		}
		public function getMenu() {
			$backend_menu = hObjectPooler::getObject('bMenu');
			$menu_data = $backend_menu -> getMenu();
			return $menu_data;
		}
		public function displayMenu($menu_data, $type = 'display') {
			if(is_null($type)) $type = 'display';
			$displayer = hObjectPooler::getObject('dDisplayer');
			if ($type === 'display') {
				$template_name = 'menu_display';
				$slot_name = '__MENU_CONTENT__';
				$displayer -> getAndFillSlot($template_name, $slot_name);
				$template_name = 'menu_fill_content';
				$slot_name = '__HEAD_CONTENT__';
				$displayer -> getAndAppendSlot($template_name, $slot_name, $menu_data);
			} else if ($type === 'replace') {
				$var_name = 'menu_items';
				$controller_id = 'angular_menu_controller';
				$displayer -> replaceData($var_name, $menu_data, $controller_id);
			}
		}
	}
?>