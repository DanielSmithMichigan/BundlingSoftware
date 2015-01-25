<?php 
	class bBundler {
		public function handleAddPartResponse($params) {
			$part_no = $params['part_no'];
			$bundle_no = $params['bundle_no'];
			$this->addPartToBundle($part_no, $bundle_no);
		}
		public function handleCreateBundleResponse() {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$this->createBundle($user_no);
		}
		public function handleDuplicateBundleResponse($params) {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$new_params = array();
			$new_params['user_no'] = $user_no;
			$new_params['bundle_no'] = $params['bundle_no'];
			$this->duplicateBundle($new_params);
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
		public function duplicateBundle($params) {
			if (isset($params['user_no']) && isset($params['bundle_no'])) {
				$sql = " 
				insert into bundles (user_no, bundle_name, deleted, created_date, modified_date)
					select user_no, concat(bundle_name, ' Duplicate'), false, now(), now()
						from bundles where user_no = ?
						and bundle_no = ? 
						and deleted = false
				";
				$bind_param = new hBindParam();
				$bind_param->addNumber($params['user_no']);
				$bind_param->addNumber($params['bundle_no']);
				$new_bundle_id = hQueryConstructor::executeStatement($sql, $bind_param, 'insert');
				$sql = "
					insert into bundle_parts (bundle_no, part_no, deleted)
						select ? , part_no, false
							from bundle_parts
							where bundle_no = ?
							and deleted = false
				";
				$bind_param = new hBindParam();
				$bind_param->addNumber($new_bundle_id);
				$bind_param->addNumber($params['bundle_no']);
				hQueryConstructor::executeStatement($sql, $bind_param, 'insert');
			}
		}
		public function createBundle($user_no) {
			$sql = ' insert into bundles ';
			$bind_param = new hBindParam();
			$sql .= ' (user_no, created_date) values ( ';
			
			$sql .= ' ? ';
			$bind_param->addNumber($user_no);
			$sql .= ' , now() ) ';
			hQueryConstructor::executeStatement($sql, $bind_param, 'insert');
		}
		public function getBundleSkeletons ($params = array()) {
			$sql = ' select ';
			$bind_param = new hBindParam();
			$sql .= '
			bundle.user_no,
			bundle.bundle_no,
			bundle.bundle_name
			';
			$sql .= '
			from bundles bundle
				where 1 = 1
				and bundle.deleted = false
				';
			
			if (isset($params['user_no'])) {
				$sql .= ' AND bundle.user_no = ?';
				$bind_param->addString($params['user_no']);
			}
			
			if (isset($params['bundle_no'])) {
				$sql .= ' AND bundle.bundle_no = ?';
				$bind_param->addString($params['bundle_no']);
			}
			
			$sql .= ' order by bundle.bundle_no ';
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			return $results;
		}
		
		public function getBundlesWithParts ($params = array(), $group = false) {
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
				left outer join bundle_parts part_conn on part_conn.bundle_no = bundle.bundle_no
				left outer join parts part on part.part_no = part_conn.part_no
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
		public function getCurrUserBundleParts($group = false) {
			$bUser = hObjectPooler::getObject('bUser');
			$params = array();
			$params['user_no'] = $bUser->getUserNo();
			$bundles = $this->getBundlesWithParts($params, $group);
			return $bundles;
		}
		public function getCurrUserBundleSkeletons() {
			$bUser = hObjectPooler::getObject('bUser');
			$params = array();
			$params['user_no'] = $bUser->getUserNo();
			$bundles = $this->getBundleSkeletons($params);
			return $bundles;
		}
		public function getAndFormatCurrUserBundles() {
			$bundle_parts = $this->getCurrUserBundleParts(true);
			$bundle_skeletons = $this->getCurrUserBundleSkeletons(true);
			$params = array();
			$params['input_bundles_with_parts'] = $bundle_parts;
			$params['bundle_skeletons'] = $bundle_skeletons;
			$bundles = $this->formatBundles($params);
			return $bundles;
		}
		public function formatBundles($params) {
			$output_bundles = array();
			$input_bundles_with_parts = $params['input_bundles_with_parts'];
			$bundle_skeletons = $params['bundle_skeletons'];
			foreach($bundle_skeletons as $input_bundle) {
				$output_bundles[$input_bundle['bundle_no']] = array();
				$output_bundles[$input_bundle['bundle_no']]['bundle_no'] = $input_bundle['bundle_no'];
				$output_bundles[$input_bundle['bundle_no']]['bundle_name'] = $input_bundle['bundle_name'] ?: 'Bundle';
				$output_bundles[$input_bundle['bundle_no']]['parts'] = array();
				$output_bundles[$input_bundle['bundle_no']]['price'] = 0;
			}
			foreach($input_bundles_with_parts as $input_bundle) {
				$output_bundles[$input_bundle['bundle_no']]['parts'][$input_bundle['bundle_part_no']] = $input_bundle;
				$output_bundles[$input_bundle['bundle_no']]['price'] += $input_bundle['price'] * $input_bundle['qty'];
			}
			return $output_bundles;
		}
		public function attemptDeleteBundle($params) {
			$bUser = hObjectPooler::getObject('bUser');
			$new_params = array();
			$new_params['user_no'] = $bUser->getUserNo();
			$new_params['bundle_no'] = $params['bundle_no'];
			$bundles = $this->getBundleSkeletons($new_params);
			$table_name = 'bundles';
			$primary_key_column = 'bundle_no';
			$records = array();
			$records[] = $params['bundle_no'];
			hQueryConstructor::markRecordsDeleted($table_name, $primary_key_column, $records);
		}
	} 
?>