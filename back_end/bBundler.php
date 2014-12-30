<?php 
	class bBundler {
		public function getBundles ($params = array()) {
			$sql = ' select ';
			$bind_param = new hBindParam();
			$part_columns = hConfig::getSetting('part_columns');
			$sql .= ' 
			bundle.bundle_no,
			bundle.bundle_name,
			part.part_no
			';
			foreach($part_columns as $part_column) {
				$sql .= ',part.'.$part_column;
			}
			$sql .= '
			from bundles bundle
				inner join bundle_parts part_conn on part_conn.bundle_no = bundle.bundle_no
				inner join parts part on part.part_no = part_conn.part_no
				where 1 = 1
				and deleted = false
				';
			
			if (isset($params['user_no'])) {
				$sql .= ' AND bundle.user_no = ?';
				$bind_param->addString($params['user_no']);
			}
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			return $results;
		}
		public function getCurrUserBundles() {
			$bUser = hObjectPooler::getObject('bUser');
			$params = array();
			$params['user_no'] = $bUser->getUserNo();
			$bundles = $this->getBundles($params);
			return $bundles;
		}
		public function getAndFormatCurrUserBundles() {
			$bundles = $this->getCurrUserBundles();
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
				$output_bundles[$input_bundle['bundle_no']]['parts'][$input_bundle['part_no']] = $input_bundle;
				$output_bundles[$input_bundle['bundle_no']]['price'] += $input_bundle['price'];
			}
			return $output_bundles;
		}
	} 
?>