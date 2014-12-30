<?php
	class fUser extends fInterface {
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
			$template_name = 'login_screen';
			$slot_name = '__PAGE_MAIN__';
			$displayer -> getAndFillSlot($template_name, $slot_name, $users);
		}
	}
?>