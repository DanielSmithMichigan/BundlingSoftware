<?php
	class fUser {
		public function getAndDisplayLogin() {
			$all_users = $this->getUsers();
			$this->displayLogin($all_users);
		}
		public function getUsers() {
			$user = hObjectPooler::getObject('bUser');
			$all_users = $user -> getUsers();
			return $all_users;
		}
		public function displayLogin($users) {
			$displayer = hObjectPooler::getObject('dDisplayer');
			$displayer -> getAndFillSlot('top_bar', '__PAGE_CONTENT__');
			$template_name = 'user_login_instruction';
			$slot_name = '__TOP_SECTION__';
			$displayer -> getAndFillSlot($template_name, $slot_name);
			$template_name = 'front_display';
			$slot_name = '__BOTTOM_SECTION__';
			$displayer -> getAndFillSlot($template_name, $slot_name);
			$adapt_array = array();
			$adapt_array[] = array('source' => 'user_name', 'target' => 'item_display');
			$adapt_array[] = array('source' => 'user_name', 'target' => 'item_name');
			$adapt_array[] = array('source' => 'user_no', 'target' => 'inputs/user_no');
			$adapted_array = hAdapter::adaptEach($adapt_array, $users);
			$template_name = 'fill_front';
			$slot_name = '__HEAD_CONTENT__';
			$displayer -> getAndAppendSlot($template_name, $slot_name, $adapted_array);	
		}
	}
?>