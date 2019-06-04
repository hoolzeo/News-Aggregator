<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

$data = $_POST;
if ( isset($data['do_login']) )
{
	$user = R::findOne('users', 'login = ?', array($data['login']));
	if ( $user )
	{
		//логин существует
		if ( password_verify($data['password'], $user->password) )
		{
			//если пароль совпадает, то нужно авторизовать пользователя
			$_SESSION['logged_user'] = $user;
			header('Location: /');
		}else
		{
			ShowMessage('Неверно введен пароль!');
		}

	} else {
		ShowMessage('Пользователь с таким логином не найден!');
	}
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>

  <title>Авторизация</title>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/meta.php'; ?>
</head>
<body>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/header.php'; ?>

  <div class="wrapper container">
    <main>
      <h1>Авторизация</h1>

			<form action="login.php" method="POST">

				<style media="screen">



				</style>

				<div class="input-block">
					<strong>Логин</strong>
					<input type="text" name="login" value="<?php echo @$data['login']; ?>"><br/>
				</div>

				<div class="input-block">
					<strong>Пароль</strong>
					<input type="password" name="password" value="<?php echo @$data['password']; ?>"><br/>
				</div>

				<button type="submit" name="do_login">Войти</button>
			</form>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/sidebar.php'; ?>

  </div>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/footer.php'; ?>

</body>

</html>
