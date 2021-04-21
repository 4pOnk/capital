<?php 

require  '../controller/DB.php';
$db = new Database();
session_start();

$res = array();
$res['status'] = true;

$login = $_POST['login'];

$user_login = $db -> select('users',"`id`={$_SESSION['user']}")[0]['login'];

if($login == $user_login){
	$res['status'] = false;
	$res['message'] = "Вы не можете дарить акции самому себе";
}else if($db -> count_res('users',"`login`='$login'") == 0){
	$res['status'] = false;
	$res['message'] = "Пользователя с таким логином нет";
}

echo json_encode($res);