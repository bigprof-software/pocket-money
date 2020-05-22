<?php
	$hooks_dir = dirname(__FILE__);
	include("{$hooks_dir}/../defaultLang.php");
	include("{$hooks_dir}/../language.php");
	include("{$hooks_dir}/../lib.php");
	
	$debug = [];
	auto_deposit_pocket_money_weekly($debug);

	print_r($debug);
