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
			$template_name = 'menu_display';
			$slot_name = '__MENU_CONTENT__';
			if ($type === 'display') {
				$displayer -> getAndFillSlot($template_name, $slot_name, $menu_data);
			} else if ($type === 'replace') {
				$displayer -> getAndReplaceSlot($template_name, $slot_name, $menu_data);
			}
		}
	}
?>