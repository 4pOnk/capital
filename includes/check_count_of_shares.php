<?php
	require  '../controller/DB.php';
	$db = new Database();
	session_start();

	$share = $_POST['share'];

	$company_id = $db -> select('companies', "`name` = '$share'")[0]['id'];
	$count = $db -> select('shares', "`owner_id`={$_SESSION['user']} AND `company_id`='$company_id'")[0]['quantity'];

	print_r($count);