<?php
	class fPartSelector {
		public function getAndDisplayFilteredPartsList($params) {
			$bundle_no = $params['bundle_no'];
			$bParts = hObjectPooler::getObject('bParts');
			$parts_list_params = array();
			$parts = $bParts->getParts();
			$parts_list_params['parts'] = $parts;
			$part_display_config = hConfig::getSettingPair('add_part_display_order', 'add_part_display_order_names');
			$parts_list_params['part_display_config'] = $part_display_config;
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
		public function getAndUpdateFilteredPartsList($params) {
			$filter_key = $params['filter_key'];
			$filter_value = $params['filter_distinct_value'];
			$filter = array();
			$filter['part_col'] = $filter_key;
			$filter['value'] = $filter_value;
			$params = array();
			$params['filters'] = array();
			$params['filters'][] = $filter;
			$bParts = hObjectPooler::getObject('bParts');
			$parts = $bParts->getParts($params);
			$parts_list_params = array();
			$parts_list_params['parts'] = $parts;
			$part_display_config = hConfig::getSettingPair('add_part_display_order', 'add_part_display_order_names');
			$parts_list_params['part_display_config'] = $part_display_config;
			$this->updatePartsList($parts_list_params);
		}
		public function displayPartsList($local_variables) {
			$displayer = hObjectPooler::getObject('dDisplayer');
			$slot_name = '__PARTS__';
			$html_main = $displayer->getTemplate('part_selector', $local_variables);
			$html_parts = $displayer->getTemplate('parts_individual', $local_variables, $slot_name);
			$html = $displayer->fillSlot($slot_name, $html_parts, $html_main);
			$slot_name = '__PAGE_MAIN__';
			$command = $displayer->buildReplaceSlotCommand($html, $slot_name);
			$displayer->addCommand($command);
		}
		public function updatePartsList($local_variables) {
			$displayer = hObjectPooler::getObject('dDisplayer');
			$slot_name = '__PARTS__';
			$template_name = 'parts_individual';
			$displayer->getAndReplaceSlot($template_name, $slot_name, $local_variables);
		}
	}
?>