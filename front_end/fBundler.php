<?php
	class fBundler extends fInterface {
		public function getAndDisplayCurrUserBundles() {
			$bundles = $this->getCurrUserBundles();
			$this->displayBundles($bundles);
		}
		public function getCurrUserBundles() {
			$bBundler = hObjectPooler::getObject('bBundler');
			$curr_bundles = $bBundler->getAndFormatCurrUserBundles();
			return $curr_bundles;
		}
		public function displayBundles($bundles) {
			$part_columns = hConfig::getSetting('part_columns');
			$local_variables = array();
			$local_variables['bundles'] = $bundles;
			$local_variables['part_columns'] = $part_columns;
			$local_variables['part_column_names'] = hConfig::getSetting('part_column_names');
			$local_variables['num_part_col'] = count($part_columns);
			$displayer = hObjectPooler::getObject('dDisplayer');
			$template_name = 'product_bundles';
			$slot_name = '__PAGE_MAIN__';
			$displayer -> getAndReplaceSlot($template_name, $slot_name, $local_variables);
		}
	}
?>