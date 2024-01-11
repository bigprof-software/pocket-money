<?php
// This script and data application was generated by AppGini, https://bigprof.com/appgini
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/kids.php');
	include_once(__DIR__ . '/kids_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('kids');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'kids';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`kids`.`id`" => "id",
		"`kids`.`name`" => "name",
		"`kids`.`pocket_money`" => "pocket_money",
		"`kids`.`photo`" => "photo",
		"`kids`.`last_balance`" => "last_balance",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`kids`.`id`',
		2 => 2,
		3 => '`kids`.`pocket_money`',
		4 => 4,
		5 => '`kids`.`last_balance`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`kids`.`id`" => "id",
		"`kids`.`name`" => "name",
		"`kids`.`pocket_money`" => "pocket_money",
		"`kids`.`photo`" => "photo",
		"`kids`.`last_balance`" => "last_balance",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`kids`.`id`" => "ID",
		"`kids`.`name`" => "Name",
		"`kids`.`pocket_money`" => "Pocket money",
		"`kids`.`last_balance`" => "Last balance",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`kids`.`id`" => "id",
		"`kids`.`name`" => "name",
		"`kids`.`pocket_money`" => "pocket_money",
		"`kids`.`last_balance`" => "last_balance",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`kids` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'kids_view.php';
	$x->TableTitle = 'Kids';
	$x->TableIcon = 'resources/table_icons/kids.png';
	$x->PrimaryKey = '`kids`.`id`';
	$x->DefaultSortField = '2';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 150, 150, 150, 100, ];
	$x->ColCaption = ['Name', 'Pocket money', 'Photo', 'Last balance', 'Transactions', ];
	$x->ColFieldName = ['name', 'pocket_money', 'photo', 'last_balance', '%transactions.kid%', ];
	$x->ColNumber  = [2, 3, 4, 5, -1, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/kids_templateTV.html';
	$x->SelectedTemplate = 'templates/kids_templateTVS.html';
	$x->TemplateDV = 'templates/kids_templateDV.html';
	$x->TemplateDVP = 'templates/kids_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = true;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: kids_init
	$render = true;
	if(function_exists('kids_init')) {
		$args = [];
		$render = kids_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: kids_header
	$headerCode = '';
	if(function_exists('kids_header')) {
		$args = [];
		$headerCode = kids_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: kids_footer
	$footerCode = '';
	if(function_exists('kids_footer')) {
		$args = [];
		$footerCode = kids_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
