<?php
	require('auto_loader.php');
	require('debug.php');
	session_start();
	bDatabase::connect();
	hConfig::getConfiguration();
	
	$displayer = hObjectPooler::getObject('dDisplayer');
	$user = hObjectPooler::getObject('bUser');
	$menu = hObjectPooler::getObject('fMenu');
	$permissions = hObjectPooler::getObject('bPermission');
	$action = $_POST['action'];
	hCache::setValueInternal('action', $action);
	
	switch($action) {
		case 'login':
			if ($action === 'login') {
				$user -> performLogin($_POST);
				$permissions->getPermissions();
				$menu -> getAndDisplayFrontMenu('replace');
			}
		case 'load_menu':
			if ($action === 'load_menu') {
				$menu -> getAndDisplayFrontMenu('replace');
			}
		case 'create_bundles':
			if ($action === 'create_bundles') {
				$fBundler = hObjectPooler::getObject('fBundler');
				$fBundler->getAndDisplayCurrUserBundles();
			}
		case 'update_parts':
			if ($action === 'update_parts') {
				$fUpdateParts = hObjectPooler::getObject('fUpdateParts');
				$fUpdateParts->displayFileUpload();
			}
		case 'add_part':
			if ($action === 'add_part') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->handleAddPartResponse($_POST['params']);
				$fPartSelector = hObjectPooler::getObject('fPartSelector');
				$fPartSelector->getAndUpdateFooter($_POST['params']);
			}
		case 'add_parts':
			if ($action === 'add_parts') {
				$fPartSelector = hObjectPooler::getObject('fPartSelector');
				$fPartSelector->getAndDisplayFilteredPartsList($_POST['params']);
			}
		case 'remove_part':
			if ($action === 'remove_part') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->handleRemovePartResponse($_POST['params']);
				$fPartSelector = hObjectPooler::getObject('fPartSelector');
				$fPartSelector->getAndUpdateFooter($_POST['params']);
			}
		case 'delete_bundle':
			if ($action === 'delete_bundle') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->attemptDeleteBundle($_POST['params']);
				$fBundler = hObjectPooler::getObject('fBundler');
				$fBundler->getAndDisplayCurrUserBundles();
				$displayer->addGenericCommand('congratulate', array('message' => 'Bundle Deleted'));
			}
		case 'create_bundle':
			if ($action === 'create_bundle') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->handleCreateBundleResponse();
				$fBundler = hObjectPooler::getObject('fBundler');
				$fBundler->getAndDisplayCurrUserBundles();
			}
		case 'delete_all_bundles':
			if ($action === 'delete_all_bundles') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->handleDeleteAllBundlesResponse();
				$fBundler = hObjectPooler::getObject('fBundler');
				$fBundler->getAndDisplayCurrUserBundles();
				$displayer->addGenericCommand('congratulate', array('message' => 'Bundles Deleted'));
			}
		case 'duplicate_bundle':
			if ($action === 'duplicate_bundle') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->handleDuplicateBundleResponse($_POST['params']);
				$fBundler = hObjectPooler::getObject('fBundler');
				$fBundler->getAndDisplayCurrUserBundles();
			}
		case 'add_filter':
			if ($action === 'add_filter') {
				$fPartSelector = hObjectPooler::getObject('fPartSelector');
				$fPartSelector->getAndUpdateFilteredPartsList($_POST);
			}
		case 'customer_view':
			if ($action === 'customer_view') {
				$fPartSelector = hObjectPooler::getObject('fCustomerView');
				$fPartSelector->getAndDisplayCustomerView($_POST);
			}
		case 'update_bundle_title':
			if ($action === 'update_bundle_title') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->updateBundleTitle($_POST['params']);
				$displayer->addGenericCommand('congratulate', array('message' => 'Bundle Title Updated'));
			}
		case 'update_bundle_final_price':
			if ($action === 'update_bundle_final_price') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->updateBundleFinalPrice($_POST['params']);
				$fBundler = hObjectPooler::getObject('fBundler');
				$fBundler->getAndDisplayCurrUserBundles();
			}	
		case 'remove_bundle_final_price':
			if ($action === 'remove_bundle_final_price') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->removeBundleFinalPrice($_POST['params']);
				$fBundler = hObjectPooler::getObject('fBundler');
				$fBundler->getAndDisplayCurrUserBundles();
			}		
		case 'update_warranty':
			if ($action === 'update_warranty') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->updateBundleWarranty($_POST['params']);
				$fBundler = hObjectPooler::getObject('fBundler');
				$fBundler->getAndDisplayCurrUserBundles();
				$displayer->addGenericCommand('congratulate', array('message' => 'Bundle Warranty Updated'));
			}		
		case 'save_description_override':
			if ($action === 'save_description_override') {
				$bBundler = hObjectPooler::getObject('bBundler');
				$bBundler->saveDescriptionOverride($_POST['params']);
				$fBundler = hObjectPooler::getObject('fBundler');
				$fBundler->getAndDisplayCurrUserBundles();
				$displayer->addGenericCommand('congratulate', array('message' => 'Description overridden'));
			}
		case 'manage_observations':
			if ($action === 'manage_observations') {
				$fObservations = hObjectPooler::getObject('fObservations');
				$fObservations->getAndDisplayObservations();
			}
		case 'add_observation':
			if ($action === 'add_observation') {
				$bObservations = hObjectPooler::getObject('bObservations');
				$bObservations->addCurrUserObservation($_POST['params']);
				$fObservations = hObjectPooler::getObject('fObservations');
				$fObservations->getAndDisplayObservations();
			}
		case 'delete_observation':
			if ($action === 'delete_observation') {
				$bObservations = hObjectPooler::getObject('bObservations');
				$bObservations->deleteCurrUserObservation($_POST['params']);
				$fObservations = hObjectPooler::getObject('fObservations');
				$fObservations->getAndDisplayObservations();
			}
		case 'delete_observations':
			if ($action === 'delete_observations') {
				$bObservations = hObjectPooler::getObject('bObservations');
				$bObservations->deleteCurrUserObservations();
				$fObservations = hObjectPooler::getObject('fObservations');
				$fObservations->getAndDisplayObservations();
			}
		default:
			$menu -> getAndDisplayMenu('replace');
		break;
	}
	
	$displayer->performCommands();
	bDatabase::disconnect();
?>