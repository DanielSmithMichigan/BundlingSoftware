<?php
	class fMenu {
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
		public function displayFrontMenu($menu_data, $type = 'display') {
			if(is_null($type)) $type = 'display';
			$displayer = hObjectPooler::getObject('dDisplayer');
			if ($type === 'display') {
				$displayer -> getAndFillSlot('top_bar', '__PAGE_CONTENT__');
				$template_name = 'what_do_you_want_to_do';
				$slot_name = '__TOP_SECTION__';
				$displayer -> getAndFillSlot($template_name, $slot_name);
				$template_name = 'front_display';
				$slot_name = '__BOTTOM_SECTION__';
				$displayer -> getAndFillSlot($template_name, $slot_name);
				$adapt_array = array();
				$adapt_array[] = array('source' => 'glyphicon', 'target' => 'glyphicon');
				$adapt_array[] = array('source' => 'menu_item_display', 'target' => 'item_display');
				$adapt_array[] = array('source' => 'menu_item_name', 'target' => 'item_name');
				$adapted_array = hAdapter::adaptEach($adapt_array, $menu_data);
				$template_name = 'fill_front';
				$slot_name = '__HEAD_CONTENT__';
				$displayer -> getAndAppendSlot($template_name, $slot_name, $adapted_array);
			} else if ($type === 'replace') {
				$template_name = 'what_do_you_want_to_do';
				$slot_name = '__TOP_SECTION__';
				$displayer -> getAndReplaceSlot($template_name, $slot_name);
				$template_name = 'menu_front_display';
				$slot_name = '__BOTTOM_SECTION__';
				$displayer -> getAndReplaceSlot($template_name, $slot_name);
				$template_name = 'menu_fill_front';
				$slot_name = '__HEAD_CONTENT__';
				$displayer -> getAndAppendSlot($template_name, $slot_name, $menu_data);
			}
		}
	}
?>