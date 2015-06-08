<?php 	
	class bBundler {
		public function handleAddPartResponse($params) {
			$part_num = $params['part_num'];
			$bundle_no = $params['bundle_no'];
			$type = $params['type'];
			$this->addPartToBundle($part_num, $bundle_no, $type);
			$bUser = hObjectPooler::getObject('bUser');
			$user_no = $bUser->getUserNo();
			$this->addUserPartUse($user_no, $part_num);
		}
		public function addUserPartUse($user_no, $part_num) {
			$sql = ' insert into part_uses ';
			$bind_param = new hBindParam();
			$sql .= ' (part_num, user_no, use_count) values ( ';
			
			$sql .= ' ? ';
			$bind_param->addString($part_num);
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
		public function addPartToBundle($part_num, $bundle_no, $type) {
			$sql = ' insert into bundle_parts ';
			$bind_param = new hBindParam();
			$sql .= ' (part_num, bundle_no, type) values ( ';
			
			$sql .= ' ? ';
			$bind_param->addString($part_num);
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
				insert into bundles (user_no, bundle_name, warranty_parts, description_override, warranty_labor, price_adjustment, deleted, created_date, modified_date)
					select user_no, concat(bundle_name, ' Duplicate'), warranty_parts, description_override, warranty_labor, price_adjustment, false, now(), now()
						from bundles where user_no = ?
						and bundle_no = ? 
						and deleted = false
				";
				$bind_param = new hBindParam();
				$bind_param->addNumber($params['user_no']);
				$bind_param->addNumber($params['bundle_no']);
				
				$new_bundle_id = hQueryConstructor::executeStatement($sql, $bind_param, 'insert');
				$sql = "
					insert into bundle_parts (bundle_no, part_num, type, deleted)
						select ? , part_num, type, false
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
			if (isset($params['price_adjustment']) && isset($params['bundle_no'])) {
				$bind_param = new hBindParam();
				$sql = ' 
				update bundles 
				set price_adjustment = ?
				where bundle_no = ?
				';
				$bind_param->addString($params['price_adjustment']);
				$bind_param->addNumber($params['bundle_no']);
				hQueryConstructor::executeStatement($sql, $bind_param, 'update');
			}
		}
		public function removeBundleFinalPrice($params) {
			if (isset($params['bundle_no'])) {
				$bind_param = new hBindParam();
				$sql = ' 
				update bundles 
				set price_adjustment = 0
				where bundle_no = ?
				';
				$bind_param->addNumber($params['bundle_no']);
				hQueryConstructor::executeStatement($sql, $bind_param, 'update');
			}
		}
		
		public function saveDescriptionOverride($params) {
			if (isset($params['bundle_no']) && isset($params['bundle_description'])) {
				$clean_html = hStringManager::prepareBundleDescription($params['bundle_description']);
				$bind_param = new hBindParam();
				$sql = ' 
				update bundles 
				set description_override = ?
				where bundle_no = ?
				';
				$bind_param->addString($clean_html);
				$bind_param->addNumber($params['bundle_no']);
				hQueryConstructor::executeStatement($sql, $bind_param, 'update');
			}		
		}
		public function updateBundleWarranty($params) {
			$warranty_type = false;
			
			if ($params['warranty_type'] === 'parts') {
				$warranty_type = 'warranty_parts';
			} else if ($params['warranty_type'] === 'labor') {
				$warranty_type = 'warranty_labor';
			}
			
			if ($warranty_type && isset($params['bundle_no'])) {
				$bind_param = new hBindParam();
				$sql = ' 
				update bundles ';
				
				$sql .= '
				set ';
				$sql .= $warranty_type;
				$sql .= ' = ?
				';
				
				$sql .= '
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
			bundle.warranty_parts,
			bundle.warranty_labor,
			bundle.description_override,
			bundle.price_adjustment
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
			bundle.warranty_parts,
			bundle.warranty_labor,
			bundle.description_override,
			part.appliance,
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
				left outer join parts part on part.part_num = part_conn.part_num
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
				$sql .= ' group by part_conn.type, part.part_num, bundle.bundle_no ';
			}
			$sql .= ' order by bundle.bundle_no, part_conn.type asc,part.part_num ';
			$results = hQueryConstructor::executeStatement($sql, $bind_param);
			if (!is_array($results)) {
				$results = array();
			}
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
			if (isset($params['customer_view']) && $params['customer_view'] === true) {
				$bundles = $this->sortBundlesByPrice($bundles);
			}
			return $bundles;
		}
		
		public function sortBundlesByPrice($bundles){
			usort($bundles, function($a, $b) {
				if ($a['final_price'] == $b['final_price']) {
					return 0;
				}
				return ($a['final_price'] > $b['final_price'])? -1 : 1;
			});
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
				$output_bundles[$input_bundle['bundle_no']]['warranty_parts'] = $input_bundle['warranty_parts'];
				$output_bundles[$input_bundle['bundle_no']]['warranty_labor'] = $input_bundle['warranty_labor'];
				$bundle_description = $input_bundle['description_override'];
				if (isset($params['customer_view']) && $params['customer_view'] === true) {
					$bundle_description = hStringManager::convertParagraphToRow($bundle_description);
				}
				$output_bundles[$input_bundle['bundle_no']]['description_override'] = $bundle_description;
				$output_bundles[$input_bundle['bundle_no']]['price_adjustment'] = $input_bundle['price_adjustment'];
				$output_bundles[$input_bundle['bundle_no']]['parts'] = array();
				$output_bundles[$input_bundle['bundle_no']]['parts_by_appliance'] = array();
				$output_bundles[$input_bundle['bundle_no']]['price'] = 0;
			}
			
			$this->addPartsToBundle($output_bundles, $input_bundles_with_parts);
			
			foreach($output_bundles as &$bundle) {
				$p_difference = 1;
				$a_difference = 0;
				$zero_price_flag = false;
				$no_parts_flag = count($bundle['parts']) === 0;
				$modified_price = false;
				$customer_view = isset($params['customer_view']) && $params['customer_view'] === true;
				$bundle['final_price'] = round($bundle['price'] + $bundle['price_adjustment'], 2);
				if ((float)$bundle['price_adjustment'] !== 0.0) {
					$modified_price = true;
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
		
		public function addPartsToBundle(&$bundles, $parts) {
			foreach($parts as $part) {
				$this->addPartToFormattedBundle($bundles[$part['bundle_no']], $part);
			}
		}
		
		public function addPartToFormattedBundle(&$bundle, $part) {
			$this->addPartToBundleAppliance($bundle['parts_by_appliance'], $part);
			$bundle['parts'][$part['bundle_part_no']] = $part;
			$bundle['price'] += $part['price'] * $part['qty'];
		}
		
		public function addPartToBundleAppliance(&$bundle_appliance, $part) {
			$appliance = $part['appliance'];
			if (!isset($bundle_appliance[$appliance])) {
				$bundle_appliance[$appliance] = array();
				$bundle_appliance[$appliance]['title'] = $appliance;
				$bundle_appliance[$appliance]['part_names'] = array();
			}
			if ($part['qty'] > 1) {
				$bundle_appliance[$appliance]['part_names'][] = $part['part_description'] . ' x' . $part['qty'];
			} else {
				$bundle_appliance[$appliance]['part_names'][] = $part['part_description'];
			}
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