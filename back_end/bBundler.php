<?php 
	class bBundler {
		public function handleAddPartResponse($params) {
			$part_no = $params['part_no'];
			$bundle_no = $params['bundle_no'];
			$type = $params['type'];
			$this->addPartToBundle($part_no, $bundle_no, $type);
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$this->addUserPartUse($user_no, $part_no);
		}
		public function addUserPartUse($user_no, $part_no) {
			$sql = ' insert into part_uses ';
			$bind_param = new hBindParam();
			$sql .= ' (part_no, user_no, use_count) values ( ';
			
			$sql .= ' ? ';
			$bind_param->addNumber($part_no);
			$sql .= ' ,? ';
			$bind_param->addNumber($user_no);
			
			$sql .= ' , 1) 
			
			on duplicate key 
			update use_count = use_count + 1
			';
			hQueryConstructor::executeStatement($sql, $bind_param, 'insert');
		}
		public function handleCreateBundleResponse() {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$this->createBundle($user_no);
		}
		public function handleDeleteAllBundlesResponse() {
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$params = array();
			$params['user_no'] = $user_no;
			$params['DELETE_ALL_BUNDLES'] = true;
			$this->attemptDeleteBundle($params);
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
		public function addPartToBundle($part_no, $bundle_no, $type) {
			$sql = ' insert into bundle_parts ';
			$bind_param = new hBindParam();
			$sql .= ' (part_no, bundle_no, type) values ( ';
			
			$sql .= ' ? ';
			$bind_param->addNumber($part_no);
			$sql .= ' ,? ';
			$bind_param->addNumber($bundle_no);
			$sql .= ' ,? ';
			$bind_param->addString($type);
			
			$sql .= ' ) ';
			hQueryConstructor::executeStatement($sql, $bind_param, 'insert');
		}
		public function duplicateBundle($params) {
			if (isset($params['user_no']) && isset($params['bundle_no'])) {
				$sql = " 
				insert into bundles (user_no, bundle_name, bundle_warranty, final_price, deleted, created_date, modified_date)
					select user_no, concat(bundle_name, ' Duplicate'), bundle_warranty, final_price, false, now(), now()
						from bundles where user_no = ?
						and bundle_no = ? 
						and deleted = false
				";
				$bind_param = new hBindParam();
				$bind_param->addNumber($params['user_no']);
				$bind_param->addNumber($params['bundle_no']);
				$new_bundle_id = hQueryConstructor::executeStatement($sql, $bind_param, 'insert');
				$sql = "
					insert into bundle_parts (bundle_no, part_no, type, deleted)
						select ? , part_no, type, false
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
		public function updateBundleTitle($params) {
			if (isset($params['bundle_title']) && isset($params['bundle_no'])) {
				$bind_param = new hBindParam();
				$sql = ' 
				update bundles 
				set bundle_name = ?
				where bundle_no = ?
				';
				$bind_param->addString($params['bundle_title']);
				$bind_param->addNumber($params['bundle_no']);
				hQueryConstructor::executeStatement($sql, $bind_param, 'update');
			}
		}
		public function updateBundleFinalPrice($params) {
			if (isset($params['final_price']) && isset($params['bundle_no'])) {
				$bind_param = new hBindParam();
				$sql = ' 
				update bundles 
				set final_price = ?
				where bundle_no = ?
				';
				$bind_param->addString($params['final_price']);
				$bind_param->addNumber($params['bundle_no']);
				hQueryConstructor::executeStatement($sql, $bind_param, 'update');
			}
		}
		public function removeBundleFinalPrice($params) {
			if (isset($params['bundle_no'])) {
				$bind_param = new hBindParam();
				$sql = ' 
				update bundles 
				set final_price = null
				where bundle_no = ?
				';
				$bind_param->addNumber($params['bundle_no']);
				hQueryConstructor::executeStatement($sql, $bind_param, 'update');
			}
		}
		public function updateBundleWarranty($params) {
			if (isset($params['bundle_warranty']) && isset($params['bundle_no'])) {
				$bind_param = new hBindParam();
				$sql = ' 
				update bundles 
				set bundle_warranty = ?
				where bundle_no = ?
				';
				$bind_param->addString($params['bundle_warranty']);
				$bind_param->addNumber($params['bundle_no']);
				hQueryConstructor::executeStatement($sql, $bind_param, 'update');
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
			bundle.bundle_name,
			bundle.bundle_warranty,
			bundle.final_price
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
			$sql .= "
			bundle.bundle_no,
			bundle.bundle_name,
			bundle.bundle_warranty,
			part.part_no,
			part_conn.bundle_part_no,
			part_conn.type,
			case when part_conn.type = 'primary' then part.price_primary
			when part_conn.type = 'secondary' then part.price_secondary
            end as price
			";
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
				$sql .= ' group by part_conn.type, part.part_no, bundle.bundle_no ';
			}
			$sql .= ' order by bundle.bundle_no, part_conn.type asc,part.part_no ';
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
		public function getAndFormatCurrUserBundles($params = array()) {
			$bundle_parts = $this->getCurrUserBundleParts(true);
			$bundle_skeletons = $this->getCurrUserBundleSkeletons(true);
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
				$output_bundles[$input_bundle['bundle_no']]['bundle_warranty'] = $input_bundle['bundle_warranty'];
				$output_bundles[$input_bundle['bundle_no']]['final_price'] = $input_bundle['final_price'];
				$output_bundles[$input_bundle['bundle_no']]['parts'] = array();
				$output_bundles[$input_bundle['bundle_no']]['price'] = 0;
			}
			
			foreach($input_bundles_with_parts as $input_bundle) {
				$output_bundles[$input_bundle['bundle_no']]['parts'][$input_bundle['bundle_part_no']] = $input_bundle;
				$output_bundles[$input_bundle['bundle_no']]['price'] += $input_bundle['price'] * $input_bundle['qty'];
			}
			
			foreach($output_bundles as &$bundle) {
				$p_difference = 1;
				$a_difference = 0;
				$zero_price_flag = false;
				$no_parts_flag = count($bundle['parts']) === 0;
				$modified_price = false;
				$customer_view = isset($params['customer_view']) && $params['customer_view'] === true;
				if (empty($bundle['final_price'])) {
					$bundle['final_price'] = round($bundle['price'], 2);
				} else {
					$modified_price = true;
					$bundle['final_price'] = round($bundle['final_price'], 2);
					if ($bundle['price'] !== 0) {
						$p_difference = $bundle['final_price'] / $bundle['price'];
					} else {
						$zero_price_flag = true;
						$p_difference = 1;
					}
					$a_difference = $bundle['final_price'] - $bundle['price'];
				}
				
				foreach($bundle['parts'] as $part_key => &$part) {
					$part['modified_price'] = $part['price'];
					if ($customer_view) {
						$part['modified_price'] *= $p_difference;
					}
				}
				
				unset($part);
				
				foreach($bundle['parts'] as $part_key => &$part) {
					$part['cust_disp_price'] = $part['modified_price'] * $part['qty'];
					$part['desc_qty'] = $part['part_description'] . ' x' . $part['qty'];
				}
				
				unset($part);
				if (count($bundle['parts'])) {
					$bundle['parts'] = hGeneral::roundAndSquare($bundle['parts'], 'cust_disp_price', $bundle['final_price']);
				}
				
				$bundle['zero_price_flag'] = $zero_price_flag;
				$bundle['no_parts_flag'] = $no_parts_flag;
				$bundle['modified_price'] = $modified_price;
				$bundle['price_adjustment'] = $a_difference;
				
			}
			
			unset($bundle);
			return $output_bundles;
		}
		
		public function attemptDeleteBundle($params) {
			if (isset($params['bundle_no']) || (isset($params['DELETE_ALL_BUNDLES']) && $params['DELETE_ALL_BUNDLES'] === true)) {
				if (!isset($params['user_no'])) {
					$bUser = hObjectPooler::getObject('bUser');
					$user_no = $bUser->getUserNo();
				} else {
					$user_no = $params['user_no'];
				}
				if (!empty($user_no)) {
					$records = array();
					$new_params = array();
					$new_params['user_no'] = $user_no;
					if (!isset($params['DELETE_ALL_BUNDLES']) || $params['DELETE_ALL_BUNDLES'] !== true) {
						$new_params['bundle_no'] = $params['bundle_no'];
					}
					$bundles = $this->getBundleSkeletons($new_params);
					foreach($bundles as $bundle) {
						$records[] = $bundle['bundle_no'];
					}
					$table_name = 'bundles';
					$primary_key_column = 'bundle_no';
					hQueryConstructor::markRecordsDeleted($table_name, $primary_key_column, $records);
				}
			}
		}
	} 
?>