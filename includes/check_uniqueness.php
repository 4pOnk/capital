<?php 

require  '../controller/DB.php';
$db = new Database();

$check = $_POST['field'];
$value = mb_strtolower(htmlspecialchars(trim($_POST[$check])));
$table = $_POST['table'];
$key = $_POST['key'];

echo $db -> count_res($table, "`{$key}` = '$value'");
//print_r($_POST);