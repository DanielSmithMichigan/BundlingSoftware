<?php
	class bParts {
		public function getParts($params = array()) {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			
			$sql = ' select ';
			$bind_param = new hBindParam();
			$sql .= ' 
				part.*
			';
			
			$sql .= '
			from parts part
				left outer join part_uses part_use
				on (part.part_num = part_use.part_num
				and part_use.user_no = ?)
				where 1 = 1
				';
				
			$bind_param->addNumber($user_no);
				
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
			order by coalesce(part_use.use_count, 0) desc
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