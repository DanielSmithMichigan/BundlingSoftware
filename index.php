<?php
	require('auto_loader.php');
	require('debug.php');
	session_start();
	bDatabase::connect();
	$start = microtime(true);
	
	
	
	$displayer = hObjectPooler::getObject('dDisplayer');
	$backend_user = hObjectPooler::getObject('bUser');
	$menu = hObjectPooler::getObject('fMenu');
	$permissions_obj = hObjectPooler::getObject('bPermission');
	$displayer -> getAndBeginPage('page_frame');
	
	if ($backend_user->checkUserIdentified() === true) {
		$menu->getAndDisplayFrontMenu();
	} else {
		$user_display = hObjectPooler::getObject('fUser');
		$user_display -> getAndDisplayLogin();
	}
	
	
	$menu -> getAndDisplayMenu();
	$displayer->performDisplay();
	$time_elapsed_us = microtime(true) - $start;
	echo $time_elapsed_us;
	bDatabase::disconnect();
?>