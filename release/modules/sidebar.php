<aside>
  <div class="night-theme">
    Ночная тема <input type="checkbox" id="nightTheme">
  </div>

  <div class="cabinet">
    <?php
      if ( isset ($_SESSION['logged_user']) ) {
        // $userlogin = $_SESSION['logged_user']->login;
        // echo $userlogin;
        echo '<input type="submit" id="profile_view" value="Мой профиль">';
        echo '<input type="submit" id="profile_exit" value="Выйти из аккаунта">';
      } else {
        echo 'Вы не авторизованы<br/>';
        echo '<a href="/pages/cabinet/login.php">Авторизация</a>';
        echo '<a href="/pages/cabinet/signup.php">Регистрация</a>';
      }
    ?>
  </div>

  <script type="text/javascript">
  $(function() {
    $( "#profile_exit" ).click(function() {
      window.location.href = "/pages/cabinet/logout.php";
    });
  });
  </script>

  <div class="block-tags">
    <div class="block-title">Популярные теги</div>
    <div class="tags">
      <div>Путин</div>
      <div>Нотр-Дам-де-Пари</div>
      <div>Иосиф Виссарионович Сталин</div>
      <div>Россия</div>
      <div>Ювентус</div>
      <div>Аякс</div>
      <div>Владимир Александрович Зеленский</div>
      <div>Олег Владимирович Дерипаска</div>
      <div>Пётр Алексеевич Порошенко</div>
      <div>Лига чемпионов УЕФА</div>
    </div>
  </div>
</aside>

<script type="text/javascript">
$(function() {
  $( ".tags div" ).click(function() {
    var searchWord = $(this).html();
    window.location.href = "http://localhost/pages/search.php?words=" + searchWord + "&search_title=on&search_text=on";
  });
});
</script>
