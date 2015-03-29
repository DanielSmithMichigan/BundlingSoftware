<?php
	class fObservations extends fInterface {
		public function getObservations($user_no) {
			$bObservations = hObjectPooler::getObject('bObservations');
			$curr_observations = $bObservations->getObservations($user_no);
			return $curr_observations;
		}
		public function getAndDisplayObservations() {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$observations = $this->getObservations($user_no);
			$this->displayObservations($observations);
		}
		public function displayObservations($observations) {
			$local_variables = array();
			$local_variables['observations'] = $observations;
			$displayer = hObjectPooler::getObject('dDisplayer');
			$template_name = 'show_observations';
			$slot_name = '__PAGE_MAIN__';
			$displayer -> getAndReplaceSlot($template_name, $slot_name, $local_variables);
		}
	}
?>