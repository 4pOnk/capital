<?php
	session_start();
	require 'controller/DB.php';
	$db = new Database();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Capital</title>
	<link rel="stylesheet" href="/sourses/css/header.css">
</head>
<body>
	<nav style="">
		<a href="/">Главная</a>
		<a href="/cabinet.php">Мой кабинет</a>
		<a href="/market.php">Маркет</a>
		<a href="/blog.php">Блог</a>
	</nav>
