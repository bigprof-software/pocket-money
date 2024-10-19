<?php
	include(__DIR__ . "/../lib.php");
	
	$debug = [];
	auto_deposit_pocket_money_weekly($debug);

	echo '<pre>' . print_r($debug, true) . '</pre>';
