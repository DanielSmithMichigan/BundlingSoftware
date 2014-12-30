<?php
	class fMenu extends fInterface {
		public $menu_path = 'fMenu/menu_data';
		public function getMenuFromCache() {
			$path = $this->menu_path;
			$menu = hCache::getValueFromInternal($path);
			return $menu;
		}
		public function setMenuInCache($menu_data) {
			$path = $this->menu_path;
			hCache::setValueInternal($path, $menu_data);
		}
		public function verifyMenuData() {
			$output = false;
			$cache_attempt = $this->getMenuFromCache();
			if ($cache_attempt === false) {
				$output = $this->refreshCache();
			} else {
				$output = $cache_attempt;
			}
			return $output;
		}
		public function refreshCache() {
			$menu_data = $this->getMenu();
			$permissions_obj = hObjectPooler::getObject('bPermission');
			$menu_data = $permissions_obj->filterOnArrayPath($menu_data, 'menu_item_name', 'menu/');
			$this->setMenuInCache($menu_data);
			return $menu_data;
		}
		public function getAndDisplayFrontMenu($type = null) {
			$menu_data = $this->verifyMenuData();
			$this->displayFrontMenu($menu_data, $type);
		}
		public function getAndDisplayMenu($type = null) {
			$menu_data = $this->verifyMenuData();
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
			$local_variables = array();
			$local_variables['menu'] = $menu_data;
			$local_variables['curr_action'] = hCache::getValueFromInternal('action');
			$template_name = 'menu_display';
			$slot_name = '__MENU_CONTENT__';
			if ($type === 'display') {
				$displayer -> getAndFillSlot($template_name, $slot_name, $local_variables);
			} else if ($type === 'replace') {
				$displayer -> getAndReplaceSlot($template_name, $slot_name, $local_variables);
			}
		}
		public function displayFrontMenu($menu_data, $type = 'display') {
			if(is_null($type)) $type = 'display';
			$displayer = hObjectPooler::getObject('dDisplayer');
			$template_name = 'menu_front_display';
			$slot_name = '__PAGE_MAIN__';
			if ($type === 'display') {
				$displayer -> getAndFillSlot($template_name, $slot_name, $menu_data);
			} else if ($type === 'replace') {
				$displayer -> getAndReplaceSlot($template_name, $slot_name, $menu_data);
			}
		}
	}
?>