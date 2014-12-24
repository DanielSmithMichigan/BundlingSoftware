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
			$template_name = 'login_screen';
			$slot_name = '__TOP_SECTION__';
			$displayer -> getAndFillSlot($template_name, $slot_name);
			$slot_name = '__HEAD_CONTENT__';
			$template_name = 'login_screen_fill_users';
			$displayer -> getAndAppendSlot($template_name, $slot_name, $users);
		}
	}
?>