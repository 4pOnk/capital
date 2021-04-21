<?php
	include 'components/header.php';
	include 'controller/config.php';

	$user = $db -> select('users', "`id` = {$_SESSION['user']}")[0];

	$shares = $db -> select('shares',"`owner_id` = {$_SESSION['user']}");

	$notifications = $db -> select('notifications', "`user_id` = {$user['id']}");
?>

<link rel="stylesheet" href="sourses/css/cabinet.css">

<h1>Здравствуй, <span id="username"><?= $user['login'] ?> </span>
<img src="<?= $user['image_path'] ?>" alt="" height="50px" id="user_logo"></h1>
<a href="#" id="settings">Настроить</a>

<form class="settings" id="settings_change">
	<p>Логин</p>
	<input type="text" value="<?= $user['login'] ?>" name="login" id="login">
	<span id="used_alert" style="color: red"></span>
	<br><br>
	<p>Пароль</p>
	<input type="password" value="" name="password"><br>
	<span>Если не хотите менять пароль, оставьте поле нетронутым</span>
	<br><br>
	<p>Описание</p>
	<textarea name="about">
		<?= $user['about'] ?>
	</textarea>
	<p>Аватар</p>
	<input type="file" id="avatar" name="file">
	<img src="" alt="" id="avatar_preview" style="height: 50px;"><br><br>
	<input type="submit" value="Отправить" name="image">
	<h3 id="alert_user_update" style="color: red"></h3>
</form>


<h3>Балaнс: <span id="balance"><?= $user['balance'] ?></span></h3>

<div class="shares" style="margin-top: 70px; margin-left: 20px" id="my_shares">
	<h2>Мои акции</h2>
	<p id="shares_op" style="color: blue; cursor: pointer; display: inline-block;">Управлять</p><br>
	<?php 
		foreach ($shares as $key => $value) {
			$company = $db -> select('companies', "`id` = {$shares[$key]['company_id']}")[0];
			echo "<p><b class='shareName'>" . $company['name'] . "</b> - <span class='sharesCount'>" . $shares[$key][3] . "</span>шт</p>";
		}
	?>
</div>

<div id="shares_control_win" style="">
	<h2>Управленние акциями</h2><br>
	<form action="#" id="shares_control_form">
		<p>Акция</p>
		<select name="share">
			<?php 
				foreach ($shares as $key => $value) {
					$company = $db -> select('companies', "`id` = {$shares[$key]['company_id']}")[0];
					echo "<option>" . $company['name'] . "</option>";
				}
			?>
		</select><br><br>
		<p>Действие</p>
		<select name="action" id="">
			<?php 
				foreach ($config['share_actions'] as $key) {
					echo "<option>" . $key . "</option>";
				}
			?>
		</select>
		<input type="text" style="width: 40px" name="count"><span>шт.</span><br>
		<p id="shares_count_alert" style="color: red"></p>
		<br>

		<label for="" id="getter_login" style="display: none;">
			<p>Логин получателя</p>
			<input type="text" name="getter_login" id="getter_login_inp"><br>
			<p id="geter_login_alert" style="color: red"></p>
		</label>

		<label for="" id="price">
			<p>Цена</p>
			<input type="text" name="price" style="width: 70px">
		</label>
		<br>
		<h3 style="color: red" id="share_submit_alert"></h3><br>
		<input type="button" id="send_shares" value="Отправить">

	</form>
</div>


<div class="my_companies" style="margin: 50px">
	<h2>Мои компании <span id="company_create_display" style="color: blue; cursor: pointer;">+</span></h2>
	<?php 
		$own_companies = $db -> select('companies', "`owner_id` = {$user['id']}");
		if(count($own_companies) > 0):
	?>
	<div id="my_companies">
		<?php 
			foreach ($own_companies as $key => $value) {
				echo "<p><a href='company.php'>" . $own_companies[$key]['name'] . "</a></p>";
			}
		?>
	</div>
</div>

<div class="registerCompany" id="registerCompany">
	<form action="#" id="reg_company">
		<h1>Создание компании</h1>
		<br>
		<p>Название компании</p>
		<input type="text" name="name" id="comp_name">
		<span id="company_alert" style="color: red"></span><br>
		<p>Род деятельности</p>
		<select name="type">
			<?php 
				foreach ($config['comp_types'] as $key) {
					echo "<option>" . $key . "</option>";
				}
			?>
		</select>

		<p>Описание компании</p>
		<textarea name="about" id="comp_about" cols="30" rows="10">
			
		</textarea>
		<br><br>
		<p>Цена: <?= $config['company_creating_sum'] ?></p>
		<input type="button" value="Создать" id="submit_company">
		<h3 style="color: red" id="company_submit_alert"></h3>
	</form>
</div>

<div class="notifications" style="position: absolute; right: 10px; top: 50px;">
	<h2>Уведомления: <?= count($notifications)?></h2>
	<?php 
		foreach ($notifications as $key => $value) {
			echo "<p style='padding:10px'>" . $notifications[$key]['text'] . "</p>";
		}
	?>
</div>

<?php endif; ?>


<script src="sourses/js/ModalWin.js"></script>
<script src="sourses/js/ajax.js"></script>
<script src="sourses/js/change_settings.js"></script>
<script src="sourses/js/registerCompany.js"></script>
<script src="sourses/js/sharesControl.js"></script>
<?php
	include 'components/footer.php';
?>