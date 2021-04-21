<?php
	include 'components/header.php';
?>

<form class="form" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); max-width: 200px;">
	<h2>Регистрация</h2>
	<h3 style="color: red; width: 100%; word-wrap: break-word; position: relative;" id="alert"></h3>
	<p>Login:</p>
	<input type="text" id="login" name="login"><br>
	<span id="used_alert" style="color: red"></span>
	<br>
	<p>Password:</p>
	<input type="text" id="password" name="password"><br><br>
	<input type="button" value="Зарегистрироваться" id="submit">
</form>

<script src="/sourses/js/ajax.js"></script>
<script src="/sourses/js/register.js"></script>

<?php
	include 'components/footer.php';
?>