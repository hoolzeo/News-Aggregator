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
			echo '<div style="color:dreen;">Вы авторизованы!<br/> Можете перейти на <a href="/">главную</a> страницу.</div><hr>';
		}else
		{
			$errors[] = 'Неверно введен пароль!';
		}

	}else
	{
		$errors[] = 'Пользователь с таким логином не найден!';
	}

	if ( ! empty($errors) )
	{
		//выводим ошибки авторизации
		echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
	}

}
?>
<!DOCTYPE html>
<html lang="ru">
<head>

  <title>Авторизация</title>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/meta.php'; ?>
</head>
<body>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/header.php'; ?>

  <div class="wrapper container">
    <main id="sources">
      <h1>Авторизация</h1>

			<form action="login.php" method="POST">
				<strong>Логин</strong>
				<input type="text" name="login" value="<?php echo @$data['login']; ?>"><br/>

				<strong>Пароль</strong>
				<input type="password" name="password" value="<?php echo @$data['password']; ?>"><br/>

				<button type="submit" name="do_login">Войти</button>
			</form>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/sidebar.php'; ?>

  </div>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/auth.php'; ?>

</body>

</html>
