<?php
	class fPartSelector {
		public function getAndDisplayFilteredPartsList($params) {
			$parts_list_params = array();
			$bundle_no = $params['bundle_no'];
			$parts_list_params['bundle_no'] = $bundle_no;
			
			// instantiate backend classes
			$bParts = hObjectPooler::getObject('bParts');
			$bBundler = hObjectPooler::getObject('bBundler');
			
			// Get Bundled Parts
			$new_params = array();
			$new_params['bundle_no'] = $bundle_no;
			$bundled_parts = $bBundler->getBundlesWithParts($new_params);
			$parts_list_params['bundled_parts'] = $bundled_parts;
			
			// Get All Parts
			$parts = $bParts->getParts();
			$parts_list_params['parts'] = $parts;
			
			// Get Parts Display Columns
			$part_display_config = hConfig::getSettingPair('add_part_display_order', 'add_part_display_order_names');
			$parts_list_params['part_display_config'] = $part_display_config;
			$filters = hConfig::getSettingPair('part_column_filters', 'part_column_filter_names');
			
			// Get Distinct Columns for Parts
			$filter_distinct_values = array();
			foreach($filters as $filter_key => $filter_name) {
				$new_params = array('column_name' => $filter_key);
				$filter_distinct_values[$filter_key] = $bParts->getDistinctEntries($new_params);
			}
			
			// Insert filters and distinct values into parameters
			$parts_list_params['filters'] = $filters;
			$parts_list_params['filter_distinct_values'] = $filter_distinct_values;
			
			$this->displayPartsList($parts_list_params);
		}
		public function getAndUpdateFilteredPartsList($params) {			
			$new_params = array();
			if (isset($params['filters'])) {
				$new_params['filters'] = $params['filters'];
			}
			
			$bParts = hObjectPooler::getObject('bParts');
			$parts = $bParts->getParts($new_params);
			asd($parts);
			$parts_list_params = array();
			$parts_list_params['parts'] = $parts;
			$part_display_config = hConfig::getSettingPair('add_part_display_order', 'add_part_display_order_names');
			$parts_list_params['part_display_config'] = $part_display_config;
			$parts_list_params['bundle_no'] = $params['bundle_no'];
			
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
			$action = 'show_footer';
			$properties = array();
			$properties['amount'] = hConfig::getSetting('footer_size');
			$displayer->addGenericCommand($action, $properties);
			$slot_name = '__PAGE_FOOTER__';
			$template = 'bundle_parts';
			$command = $displayer->getAndReplaceSlot($template, $slot_name, $local_variables);
		}
		public function updatePartsList($local_variables) {
			$displayer = hObjectPooler::getObject('dDisplayer');
			$slot_name = '__PARTS__';
			$template_name = 'parts_individual';
			$displayer->getAndReplaceSlot($template_name, $slot_name, $local_variables);
		}
		public function getAndUpdateFooter($params) {
			$displayer = hObjectPooler::getObject('dDisplayer');
			$bBundler = hObjectPooler::getObject('bBundler');
			$parts_list_params = array();
			$parts_list_params['bundle_no'] = $params['bundle_no'];
			$new_params = array();
			$new_params['bundle_no'] = $params['bundle_no'];
			$bundled_parts = $bBundler->getBundlesWithParts($new_params);
			$parts_list_params['bundled_parts'] = $bundled_parts;
			
			$action = 'show_footer';
			$properties = array();
			$properties['amount'] = hConfig::getSetting('footer_size');
			$displayer->addGenericCommand($action, $properties);
			$slot_name = '__PAGE_FOOTER__';
			$template = 'bundle_parts';
			$command = $displayer->getAndReplaceSlot($template, $slot_name, $parts_list_params);
		
		}
	}
?>