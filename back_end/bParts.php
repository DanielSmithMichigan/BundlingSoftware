<?php
	class bParts {
		public function getParts($params = array()) {
			$sql = ' select ';
			$bind_param = new hBindParam();
			$sql .= ' 
				*
			';
			
			$sql .= '
			from parts part
				where 1 = 1
				';
				
			if (isset($params['filters']) && is_array($params['filters'])) {
				foreach($params['filters'] as $filter) {
					if (empty($filter['operator'])) {
						$filter['operator'] = '=';
					}
					$sql .= ' AND part.'.$filter['part_col'].' '.$filter['operator'].' ? ';
					$bind_param->addString($filter['value']);
				}
			}
			
			$sql .= '
			limit 100
			';
			
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			return $results;
		}
		public function filtersToDistinctEntries($filters) {
			$distinct_entries = array();
		}
		public function getDistinctEntries($params = array()) {
			$output = array();
			$sql = ' select ';
			$bind_param = new hBindParam();
			$sql .= ' distinct '.$params['column_name'].' ';
			$sql .= '
			from parts part
				where 1 = 1
				';
				
			if (isset($params['filters']) && is_array($params['filters'])) {
				foreach($params['filters'] as $filter) {
					if (empty($filter['operator'])) {
						$filter['operator'] = '=';
					}
					$sql .= ' AND part.'.$filter['part_col'].' '.$filter['operator'].' ? ';
					$bind_param->addString($filter['value']);
				}
			}
			
			$sql .= '
			limit 100
			';
			
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			foreach($results as $result) {
				$output[] = $result[$params['column_name']];
			}
			return $output;
		}
	}
?>