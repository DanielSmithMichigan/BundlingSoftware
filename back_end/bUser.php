<?php
	class bUser {
		public $user_id = false;
		public function __construct () {
			$this->maintainIdentity();
		}
		public function getUserNo() {
			return $this->user_id;
		}
		public function maintainIdentity() {
			$found_user = false;
			$found_user = $this->checkUserIdentified();
			if ($found_user === false) {
				$user_id = $this->identifyUser();
				$found_user = $user_id !== false;
				if ($found_user !== false) {
					$this->setIdentity($user_id);
				} 
			}
			return $found_user;
		}
		public function performLogin($params) {
			$user_id = $params['user_no'];
			$this->setIdentity($user_id);
		}
		public function setIdentity($user_id) {
			$this->user_id = $user_id;
			$this->setCookie($user_id);
			$this->setSession($user_id);
		}
		public function checkUserIdentified() {
			$output = true;
			if ($this->user_id === false) {
				$output = false;
			}
			return $output;
		}
		public function identifyUser() {
			$user_id = false;
			$user_id = ($user_id === false)?$this->identifyBySession():$user_id;
			$user_id = ($user_id === false)?$this->identifyByCookie():$user_id;
			return $user_id;
		}
		public function setSession($user_id) {
			if (!isset($_SESSION['user'])) {
				$_SESSION['user'] = array();
			}
			$_SESSION['user']['user_id'] = $user_id;
		}
		public function setCookie($user_id) {
			$expire_time = time()+60*60*24*30;
			setcookie('user_id', $user_id, $expire_time);
		}
		public function identifyByCookie() {
			$user_id = false;
			if (isset($_COOKIE['user_id'])) {
				$user_id = $_COOKIE['user_id'];
			}
			return $user_id;
		}
		public function identifyBySession() {
			$user_id = false;
			if (isset($_SESSION['user']['user_id'])) {
				$user_id = $_SESSION['user']['user_id'];
			}
			return $user_id;
		}
		public function identifyByIpAddress() {
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$new_params = array();
			$new_params['ip_address'] = $ip_address;
			$search_results = $this->searchIpAddresses($new_params);
		}
		public function searchIpAddresses($params = array()) {
			$sql = ' select ';
			$bind_param = new hBindParam();
			
			$sql .= ' ip.ip_address as ip_address, ip.user_no as user_no from ip_addresses ip 
			where 1 = 1 ';
			
			if (isset($params['ip_address'])) {
				$sql .= ' AND ip.ip_address = ? ';
				$bind_param->addString($params['ip_address']);
			}
			if (isset($params['user_no'])) {
				$sql .= ' AND ip.user_no = ? ';
				$bind_param->addNumber($params['user_no']);
			}
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			return $results;
		}
		public function getUsers($params = array()) {
			$sql = ' select ';
			$bind_param = new hBindParam();
			
			$sql .= ' usr.user_name as user_name
			,usr.user_no from users usr
			where 1 = 1 ';
			
			if (isset($params['user_name'])) {
				$sql .= ' AND usr.user_name = ?';
				$bind_param->addString($params['user_name']);
			}
			
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			return $results;
		}
	}
?>