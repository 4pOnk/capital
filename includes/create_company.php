<?php
include '../controller/config.php';

require  '../controller/DB.php';
$db = new Database();

session_start();

$arr = array();
$arr['status'] = false;

$name = htmlspecialchars(trim($_POST['name']));
$about = htmlspecialchars(trim($_POST['about']));
$type = htmlspecialchars(trim($_POST['type']));

$user = $db -> select('users', "`id`={$_SESSION['user']}")[0];
$company_creating_sum = $config['company_creating_sum'];

if($db -> count_res('companies',"`name`='$name'") == 0 && $name != '' && +$user['balance'] >= +$config['company_creating_sum']){
	$db -> insert('companies', ['name','owner_id','description','type'],[$name,$user[0],$about,$type]);
	$db -> update('users', ['balance'],["`balance`-$company_creating_sum"],"`id`={$user['id']}",true);

	$company_id = $db -> select('companies',"`name`='$name'")[0][0];

	$db -> insert('shares',['owner_id','company_id','quantity'],[$_SESSION['user'],$company_id,$config['creating_min_shares']]);
	$arr['status'] = true;
	$arr['balance'] = $db -> select('users', "`id`={$_SESSION['user']}")[0]['balance'];
	$arr['shares'] = $config['creating_min_shares'];
}elseif ($name == '')
	$arr['message'] = "Введите имя компании";
elseif(+$user['balance'] < +$config['company_creating_sum'])
	$arr['message'] = "Недостаточно денег";
else{
	$arr['message'] = '';
}

echo json_encode($arr);