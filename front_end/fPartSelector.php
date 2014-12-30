<?php
	class fPartSelector {
		public function getAndDisplayFilteredPartsList($params) {
			$bundle_no = $params['bundle_no'];
			$bParts = hObjectPooler::getObject('bParts');
			$parts_list_params = array();
			$filters = hConfig::getSettingPair('part_column_filters', 'part_column_filter_names');
			$filter_distinct_values = array();
			foreach($filters as $filter_key => $filter_name) {
				$new_params = array('column_name' => $filter_key);
				$filter_distinct_values[$filter_key] = $bParts->getDistinctEntries($new_params);
			}
			$parts_list_params['filters'] = $filters;
			$parts_list_params['filter_distinct_values'] = $filter_distinct_values;
			$this->displayPartsList($parts_list_params);
		}
		public function displayPartsList($local_variables) {
			$displayer = hObjectPooler::getObject('dDisplayer');
			$template_name = 'part_selector';
			$slot_name = '__PAGE_MAIN__';
			$displayer -> getAndReplaceSlot($template_name, $slot_name, $local_variables);
		}
	}
?>