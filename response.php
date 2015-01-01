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
		case 'add_filter':
			if ($action === 'add_filter') {
				$fPartSelector = hObjectPooler::getObject('fPartSelector');
				$fPartSelector->getAndUpdateFilteredPartsList($_POST['params']);
			}
		default:
			$menu -> getAndDisplayMenu('replace');
		break;
	}
	
	$displayer->performCommands();
	bDatabase::disconnect();
?>