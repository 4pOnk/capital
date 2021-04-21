<?php
session_start();

require  '../controller/DB.php';
$db = new Database();

 $share_name = $_POST['share'];
 $action = $_POST['action'];
 $count = htmlspecialchars(trim($_POST['count']));
 $getter_login = $_POST['getter_login'];
 $price = htmlspecialchars(trim($_POST['price']));


if(!empty($count))$count = abs($count);
if(!empty($price))$price = abs($price);

$res = array();
$res['status'] = true;

$company = $db -> select('companies', "`name`='$share_name'")[0];
$company_id = $company[0];
$user = $db -> select('users', "`id`={$_SESSION['user']}")[0];

$share = $db -> select('shares',"`owner_id`={$_SESSION['user']} AND `company_id`={$company_id}")[0];
$gettrs_count = $db -> count_res('users',"`login`='{$getter_login}'");

if(!empty($share_name) && !empty($action) && !empty($count) && (!empty($getter_login) || !empty($price)) && +$share['quantity'] >= +$count && !empty($share)){
	if(!(+$share['quantity'] == +$count && $company['owner_id'] == $_SESSION['user']) && $action == "Продать" && !empty($price)){
		$db -> insert('market',['product_type','product_id','seller_id','cost','quantity'],[1,$company_id,$user['id'],$price,$count]);
		$db -> update('shares',['quantity'],["`quantity`-{$count}"],"`owner_id`={$_SESSION['user']} AND `company_id`={$company_id}",true);
	}elseif($action == "Продать" && empty($price)){
		$res['status'] = false;
		$res['message'] = 'Укажите цену товара';
	}elseif($action == "Продать" && +$share['quantity'] == +$count && $company['owner_id'] == $_SESSION['user']){
		$res['status'] = false;
		$res['message'] = 'Вы не можете продать <br> все акции своей компании';
	}else if(!(+$share['quantity'] == +$count && $company['owner_id'] == $_SESSION['user']) && $action == 'Подарить' && !empty($getter_login) && $gettrs_count >= 1){
		$getter = $db -> select('users',"`login`='{$getter_login}'")[0];
		$db -> update('shares',['quantity'],["`quantity`-{$count}"],"`owner_id`={$_SESSION['user']} AND `company_id`={$company_id}",true);
		$have_getter_share = $db -> count_res('shares', "`owner_id`={$getter['id']} AND `company_id`={$company_id}");

		if($have_getter_share >= 1){
			$db -> update('shares',['quantity'],["`quantity`+{$count}"],"`owner_id`={$getter['id']} AND `company_id`={$company_id}",true);
		}else{
			$db -> insert('shares',['owner_id','company_id','quantity'],[$getter['id'], $company_id, $count]);
		}
	}else if($gettrs_count <= 0){
		$res['status'] = false;
	}
}elseif (empty($share)) {
	$res['status'] = false;
	$res['message'] = 'У вас нет аций с таким названием';
}elseif(+$share['quantity'] < +$count){
	$res['status'] = false;
}else{
	$res['status'] = false;
	$res['message'] = 'Пожалуйста, заполните все поля';
}
echo json_encode($res);