<?php 
	class bBundler {
		public function handleAddPartResponse($params) {
			$part_no = $params['part_no'];
			$bundle_no = $params['bundle_no'];
			$this->addPartToBundle($part_no, $bundle_no);
		}
		public function handleRemovePartResponse($params) {
			$table_name = 'bundle_parts';
			$primary_key_column = 'bundle_part_no';
			$records = array();
			$records[] = $params['bundle_part_no'];
			hQueryConstructor::markRecordsDeleted($table_name, $primary_key_column, $records);
		}
		public function addPartToBundle($part_no, $bundle_no) {
			$sql = ' insert into bundle_parts ';
			$bind_param = new hBindParam();
			$sql .= ' (part_no, bundle_no) values ( ';
			
			$sql .= ' ? ';
			$bind_param->addNumber($part_no);
			$sql .= ' ,? ';
			$bind_param->addNumber($bundle_no);
			
			$sql .= ' ) ';
			hQueryConstructor::executeStatement($sql, $bind_param, 'insert');
		}
		public function getBundles ($params = array(), $group = false) {
			$sql = ' select ';
			$bind_param = new hBindParam();
			$part_columns = hConfig::getSetting('part_columns');
			if ($group === true) {
				$sql .= ' count(*) as qty, ';
			}
			$sql .= '
			bundle.bundle_no,
			bundle.bundle_name,
			part.part_no,
			part_conn.bundle_part_no,
			part.price
			';
			foreach($part_columns as $part_column) {
				$sql .= ',part.'.$part_column;
			}
			$sql .= '
			from bundles bundle
				inner join bundle_parts part_conn on part_conn.bundle_no = bundle.bundle_no
				inner join parts part on part.part_no = part_conn.part_no
				where 1 = 1
				and bundle.deleted = false
				and part_conn.deleted = false
				';
			
			if (isset($params['user_no'])) {
				$sql .= ' AND bundle.user_no = ?';
				$bind_param->addString($params['user_no']);
			}
			
			if (isset($params['bundle_no'])) {
				$sql .= ' AND bundle.bundle_no = ?';
				$bind_param->addString($params['bundle_no']);
			}
			if ($group === true) {
				$sql .= ' group by part.part_no, bundle.bundle_no ';
			}
			$sql .= ' order by bundle.bundle_no ';
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			return $results;
		}
		public function getCurrUserBundles($group = false) {
			$bUser = hObjectPooler::getObject('bUser');
			$params = array();
			$params['user_no'] = $bUser->getUserNo();
			$bundles = $this->getBundles($params, $group);
			return $bundles;
		}
		public function getAndFormatCurrUserBundles() {
			$bundles = $this->getCurrUserBundles(true);
			$bundles = $this->formatBundles($bundles);
			return $bundles;
		}
		public function formatBundles($input_bundles) {
			$output_bundles = array();
			foreach($input_bundles as $input_bundle) {
				if (!isset($output_bundles[$input_bundle['bundle_no']])) {
					$output_bundles[$input_bundle['bundle_no']] = array();
					$output_bundles[$input_bundle['bundle_no']]['bundle_no'] = $input_bundle['bundle_no'];
					$output_bundles[$input_bundle['bundle_no']]['bundle_name'] = $input_bundle['bundle_name'] ?: 'Bundle';
					$output_bundles[$input_bundle['bundle_no']]['parts'] = array();
					$output_bundles[$input_bundle['bundle_no']]['price'] = 0;
				}
				$output_bundles[$input_bundle['bundle_no']]['parts'][$input_bundle['bundle_part_no']] = $input_bundle;
				$output_bundles[$input_bundle['bundle_no']]['price'] += $input_bundle['price'] * $input_bundle['qty'];
			}
			return $output_bundles;
		}
	} 
?>