<?php
	class fCustomerView extends fInterface {
		public function getCustomerView() {
			$bBundler = hObjectPooler::getObject('bBundler');
			$params = array();
			$params['customer_view'] = true;
			$curr_bundles = $bBundler->getAndFormatCurrUserBundles($params);
			return $curr_bundles;
		}
		public function getAndDisplayCustomerView() {
			$bundles = $this->getCustomerView();
			$this->displayCustomerView($bundles);
		}
		public function displayCustomerView($bundles) {
			$part_columns = hConfig::getSetting('part_columns_cust', true);
			$local_variables = array();
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