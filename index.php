<?php
	include 'components/header.php';
?>


<form class="form" <?php if($_SESSION['user'])echo "style = 'display:none'"; ?> id="form">
	<h2>Войти</h2>
	<h3 style="color: red; width: 100%; word-wrap: break-word; position: relative;" id="alert"></h3>
	<p>Login:</p>
	<input type="text" id="login" name="login"><br><br>
	<p>Password:</p>
	<input type="text" id="password" name="password"><br><br>
	<input type="button" value="Войти" id="submit">
	<p>Нет аккаунта? <a href="/registration.php"> Зарегистрироваться </a></p>
</form>

<?php if($_SESSION['user']): ?>
	<a href="#" class="logout" id="logout">Выйти</a>
<?php endif; ?>
	<a href="#" class="logout" id="logout_win" style="display: none;">Выйти</a>

<script src="/sourses/js/ajax.js"></script>
<script src="/sourses/js/login.js"></script>
<script src="/sourses/js/logout.js"></script>


<?php
	include 'components/footer.php';
?>