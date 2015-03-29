<?php
	class fCustomerView extends fInterface {
		public function getCustomerViewBundles() {
			$bBundler = hObjectPooler::getObject('bBundler');
			$params = array();
			$params['customer_view'] = true;
			$curr_bundles = $bBundler->getAndFormatCurrUserBundles($params);
			usort($curr_bundles, function($a, $b) {
				return ($a['final_price'] - $b['final_price']);
			});
			return $curr_bundles;
		}
		public function getCustomerViewObservations() {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$bObservations = hObjectPooler::getObject('bObservations');
			$observations = $bObservations->getObservations($user_no);
			return $observations;
		}
		public function getAndDisplayCustomerView() {
			$bundles = $this->getCustomerViewBundles();
			$observations = $this->getCustomerViewObservations();
			$this->displayCustomerView($bundles, $observations);
		}
		public function displayCustomerView($bundles, $observations) {
			$part_columns = hConfig::getSetting('part_columns_cust', true);
			$local_variables = array();
			$local_variables['observations'] = $observations;
			$local_variables['bundles'] = $bundles;
			$local_variables['part_columns'] = $part_columns;
			$local_variables['part_column_names'] = hConfig::getSetting('part_column_names_cust', true);
			$local_variables['num_part_col'] = count($part_columns);
			$displayer = hObjectPooler::getObject('dDisplayer');
			$template_name = 'customer_view';
			$slot_name = '__PAGE_MAIN__';
			$displayer -> getAndReplaceSlot($template_name, $slot_name, $local_variables);
		}
	}
?>