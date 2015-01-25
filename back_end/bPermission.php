<?php
	class bPermission {
		public $available_permissions;
		public function __construct() {
			$this->getPermissions();
		}
		public function getPermissions() {
			$user_obj = hObjectPooler::getObject('bUser');
			if ($user_obj->checkUserIdentified()) {
				$this->available_permissions['menu'] = array();
				$this->available_permissions['menu']['create_bundles'] = true;
				$this->available_permissions['menu']['customer_view'] = true;
			} else {
				$this->available_permissions['menu'] = array();
				$this->available_permissions['menu']['user_login'] = true;
			}
		}
		public function hasPermission($permission_path) {
			return hPathFollower::followPathSlash($permission_path, $this->available_permissions);
		}
		public function filterOnArrayPath($unfiltered_array, $element_path, $prefix = '') {
			$filtered_array = $unfiltered_array;
			foreach ($unfiltered_array as $array_key => $array_element) {
				$element_id = hPathFollower::followPathSlash($element_path, $array_element);
				$permission_path = $prefix . $element_id;
				if (hPathFollower::followPathSlash($permission_path, $this->available_permissions) !== true) {
					unset($filtered_array[$array_key]);
				}
			}
			return $filtered_array;
		}
	}
?>