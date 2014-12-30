<?php
	require('auto_loader.php');
	require('debug.php');
	session_start();
	bDatabase::connect();
	hConfig::getConfiguration();
	$start = microtime(true);
	
	// initialize all front end objects
	$menu = hObjectPooler::getObject('fMenu');
	
	
	$displayer = hObjectPooler::getObject('dDisplayer');
	$backend_user = hObjectPooler::getObject('bUser');
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
	//echo $time_elapsed_us;
	bDatabase::disconnect();
?>