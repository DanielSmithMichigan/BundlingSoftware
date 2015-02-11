<?php
	class fCustomerView extends fInterface {
		public function getCustomerView() {
			$bBundler = hObjectPooler::getObject('bBundler');
			$curr_bundles = $bBundler->getAndFormatCurrUserBundles();
			return $curr_bundles;
		}
		public function getAndDisplayCustomerView() {
			$bundles = $this->getCustomerView();
			$this->displayCustomerView($bundles);
		}
		public function displayCustomerView($bundles) {
			$part_columns = hConfig::getSetting('part_columns_cust', true);
			$local_variables = array();
			$bundles = $this->addExtraAttributesToBundles($bundles);
			$local_variables['bundles'] = $bundles;
			$local_variables['part_columns'] = $part_columns;
			$local_variables['part_column_names'] = hConfig::getSetting('part_column_names_cust', true);
			$local_variables['num_part_col'] = count($part_columns);
			$displayer = hObjectPooler::getObject('dDisplayer');
			$template_name = 'customer_view';
			$slot_name = '__PAGE_MAIN__';
			$displayer -> getAndReplaceSlot($template_name, $slot_name, $local_variables);
		}
		public function addExtraAttributesToBundles($bundles) {
			foreach($bundles as $bundle_key => $bundle) {
				foreach($bundle['parts'] as $part_key => $part) {
					$bundles[$bundle_key]['parts'][$part_key]['desc_qty'] = $part['part_description'] . ' x' . $part['qty'];
					$bundles[$bundle_key]['parts'][$part_key]['disp_price'] = $part['price'] * $part['qty'];
				}
			}
			return $bundles;
		}
	}
?>