<?php 

require  '../controller/DB.php';
session_start();


$login = htmlspecialchars(trim($_POST['login']));
$password = htmlspecialchars(trim($_POST['password']));

$login = implode("", explode("'", $login));

if(!empty($login) && !empty($password)){

	$password = md5($password);

	$db = new Database();

	$res = $db -> count_res("users", "`login` = '$login'");

	if($res == 0){
		$db -> insert("users",['login','password'], ["$login","$password"]);
		$user = $db -> select("users", "`login` = '$login'");
		$_SESSION['user'] = $user[0]['id'];
	}else
		echo 'Пользователь с такими данными уже зарегистрирован';
}else
	echo 'Пожалуйста, заполните все поля!';