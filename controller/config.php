<?php
	$config = array(
		'db_name' => 'capital',
		'db_host' => 'localhost',
		'db_user' => 'root',
		'db_password' => '',
		'title' => 'Capital',
		'logo' => '',
		'dynamic_loading' => 10,
		'creating_min_shares' => 1000,
		'min_tax' => 5000,
		'tax_buff_percents' => 0.2, //tax = min_tax + profit * tax_buff_percents
		'starter_sum' => 100,
		'company_creating_sum' => 10000,
		'min_profit' => 1000,
		'level_up_percents' => 0.3,
		'level_up_min_price' => 5000,
		'allowed_types' => ['image/jpeg','image/png'],
		'comp_types' => ['Техника','Бытовые товары','Продовольствие','Медикаменты','Услуги','IT составляющая'],
		'share_actions' => ['Продать','Подарить']
	);

	return $config;