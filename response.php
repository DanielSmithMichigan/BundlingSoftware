<?php
	require('auto_loader.php');
	require('debug.php');
	bDatabase::connect();
	
	$displayer = hObjectPooler::getObject('dDisplayer');
	$user = hObjectPooler::getObject('bUser');
	$menu = hObjectPooler::getObject('fMenu');
	$permissions = hObjectPooler::getObject('bPermission');
	$permissions -> getPermissions();
	$action = $_POST['action'];
	
	if ($action === 'login') {
		$user -> performLogin($_POST);
		$permissions -> getPermissions();
		$menu -> getAndDisplayMenu('replace');
	}
	
	$displayer->performCommands();
	bDatabase::disconnect();
?>