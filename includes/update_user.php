<?php

require  '../controller/DB.php';
include  '../controller/config.php';

session_start();

$db = new Database();
$user = $db -> select('users', "`id` = '{$_SESSION['user']}'")[0];

$login = htmlspecialchars(trim($_POST['login']));
$password = htmlspecialchars(trim($_POST['password']));
$about = htmlspecialchars(trim($_POST['about']));
$file = $_FILES['file'];

$login = implode("", explode("'", $login));

$response = array();

$response['status'] = true;
$response['login'] = $login;


if($_GET['preview'] == 1 && $file['size'] > 0 && array_search($file['type'], $config['allowed_types']) !== false){
	if(!empty($user['image_path'])){
		unlink('../' . $user['image_path']);
	}
	$path = 'uploads/' . time() . rand( 0, 1000 ) . $file['name'];
	move_uploaded_file($file['tmp_name'], '../' . $path);
	$db -> update('users',['image_path'],[$path],"`id` = {$_SESSION['user']}");
	echo $path;
}
if($_GET['preview'] != 1){
	if($db -> count_res('users', "`login` = '$login'") == 0 || $user['login'] == $login){
	$response['login'] = $login;
		if($password == ''){
			$db -> update('users',['login', 'about'],[$login,$about],"`id` = {$_SESSION['user']}");
		}else{
			$password = md5($password);
			$db -> update('users',['login', 'password', 'about'],[$login,$password,$about],"`id` = {$_SESSION['user']}");
		}
	}else{
		$response['status'] = false;
	}
	if(array_search($file['type'], $config['allowed_types']) === false && $file['size'] !== 0){
		$response['status'] = false;
		$response['type'] = $file['type'];
		$response['message'] = 'Недопустимый формат изображения';
	}
	$response['image'] = $db -> select('users', "`id` = '{$_SESSION['user']}'")[0]['image_path'];
	echo json_encode($response);
}

