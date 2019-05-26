<aside>
  <div class="night-theme">
    Ночная тема <input type="checkbox" id="nightTheme">
  </div>

	<?php if ( isset ($_SESSION['logged_user']) ) : ?>
		Авторизован! <br/>
		Привет, <?php echo $_SESSION['logged_user']->login; ?>!<br/>

		<a href="/pages/cabinet/logout.php">Выйти</a>

	<?php else : ?>
	Вы не авторизованы<br/>
	<a href="/pages/cabinet/login.php">Авторизация</a>
	<a href="/pages/cabinet/signup.php">Регистрация</a>
	<?php endif; ?>

  <div class="cabinet">
    <div class="cabinet-auth"> <input type="submit" id="auth" value="Авторизация"></div>
    <div class="cabinet-reg"> <input type="submit" id="reg" value="Регистрация"></div>
  </div>

  <div class="block-tags">
    <div class="block-title">Популярные теги</div>
    <div class="tags">
      <a href="#">Путин</a>
      <a href="#">Нотр-Дам-де-Пари</a>
      <a href="#">Иосиф Виссарионович Сталин</a>
      <a href="#">Россия</a>
      <a href="#">Ювентус</a>
      <a href="#">Аякс</a>
      <a href="#">Владимир Александрович Зеленский</a>

      <a href="#">Олег Владимирович Дерипаска</a>
      <a href="#">Пётр Алексеевич Порошенко</a>
      <a href="#">Лига чемпионов УЕФА</a>
    </div>
  </div>
</aside>
