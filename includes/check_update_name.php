<?php 

require  '../controller/DB.php';
$db = new Database();
session_start();

$name = $_POST['name'];

$user = $db -> select('users', "`id` = '{$_SESSION['user']}'")[0];

if($user['login'] !== trim($name))
	echo $db -> count_res('users', "`login` = '$name'");