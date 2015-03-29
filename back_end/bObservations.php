<?php 
	class bObservations {
		public function addCurrUserObservation($params) {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$this->addObservation($user_no, $params['observation']);
		}
		public function deleteCurrUserObservation($params) {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$this->deleteObservation($user_no, $params['observation_no']);
		}
		public function deleteCurrUserObservations() {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$observations = $this->deleteCurrUserObservationsQuery($user_no);
		}
		public function deleteCurrUserObservationsQuery($user_no) {
			$sql = ' update observations ';
			$bind_param = new hBindParam();
			$sql .= ' set deleted = 1
			where user_no = ? ';
			$bind_param->addNumber($user_no);
			hQueryConstructor::executeStatement($sql, $bind_param, 'update');
		}
		public function deleteObservation($user_no, $observation_no) {
			
			$sql = ' update observations ';
			$bind_param = new hBindParam();
			$sql .= ' set deleted = 1
			where observation_no = ? 
			and user_no = ? ';
			$bind_param->addString($observation_no);
			$bind_param->addNumber($user_no);
			hQueryConstructor::executeStatement($sql, $bind_param, 'update');
		}
		public function addObservation($user_no, $observation) {
			
			$sql = ' insert into observations ';
			$bind_param = new hBindParam();
			$sql .= ' (observation_body, user_no) values ( ';
			
			$sql .= ' ? ';
			$bind_param->addString($observation);
			$sql .= ' ,? ';
			$bind_param->addNumber($user_no);
			
			$sql .= ') 
			
			';
			hQueryConstructor::executeStatement($sql, $bind_param, 'insert');
		}
		public function getObservations ($user_no = null) {
			$bind_param = new hBindParam();
			$sql = '
				select * from observations
					where deleted = false
				';
			
			if ($user_no !== null) {
				$sql .= ' AND user_no = ?';
				$bind_param->addString($user_no);
			}
			
			$sql .= ' order by observation_no ';
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			return $results;
		}
		
	} 
?>