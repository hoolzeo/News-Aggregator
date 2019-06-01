<aside>
  <div class="night-theme upgrade-checkbox">
    Ночная тема <input type="checkbox" id="nightTheme">
  </div>

  <div class="cabinet">
    <?php
      if ( isset ($_SESSION['logged_user']) ) {
        echo '<a href="/pages/cabinet/viewprofile.php?id=' . $userID . ' ">Мой профиль</a>';
        echo '<a href="/pages/cabinet/logout.php">Выйти</a>';
      } else {
        echo 'Вы не авторизованы<br/>';
        echo '<a href="/pages/cabinet/login.php">Авторизация</a>';
        echo '<a href="/pages/cabinet/signup.php">Регистрация</a>';
      }
    ?>
  </div>

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
    window.location.href = "/pages/search.php?words=" + searchWord + "&search_title=on&search_text=on";
  });
});
</script>
