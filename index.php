<?php
	require('auto_loader.php');
	require('debug.php');
	bDatabase::connect();
	$start = microtime(true);
	
	$displayer = hObjectPooler::getObject('dDisplayer');
	$user_display = hObjectPooler::getObject('fUser');
	$menu = hObjectPooler::getObject('fMenu');
	$permissions_obj = hObjectPooler::getObject('bPermission');
	$displayer -> getAndBeginPage('page_frame');
	$displayer -> getAndFillSlot('top_bar', '__PAGE_CONTENT__');
	$user_display -> getAndDisplayLogin();
	
	$menu -> getAndDisplayMenu();
	$displayer->performDisplay();
	$time_elapsed_us = microtime(true) - $start;
	echo $time_elapsed_us;
	bDatabase::disconnect();
?>