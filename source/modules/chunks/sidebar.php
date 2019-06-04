<aside>
  <div class="night-theme upgrade-checkbox">
    Ночная тема <input type="checkbox" id="nightTheme" <?php if ((isset($_COOKIE['NightCheckBox'])) && ($_COOKIE["NightCheckBox"] == 'yes')) echo "checked"; ?>>
  </div>

  <div class="cabinet">
    <?php
      if ( isset ($_SESSION['logged_user']) ) {
        echo '<a href="/pages/cabinet/viewprofile.php?id=' . $userID . ' ">Мой профиль</a>';
        echo '<a href="/pages/cabinet/logout.php">Выйти</a>';
      } else {
        echo '<a href="/pages/cabinet/login.php">Авторизация</a>';
        echo '<a href="/pages/cabinet/signup.php">Регистрация</a>';
      }
    ?>
  </div>

  <div class="block-tags">
    <div class="block-title">Популярные теги</div>
    <div class="tags">
      <div>Путин</div>
      <div>Сталин</div>
      <div>Россия</div>
      <div>Украина</div>
      <div>Футбол</div>
      <div>Зеленский</div>
      <div>Дерипаска</div>
      <div>Порошенко</div>
      <div>Кардашьян</div>
      <div>Смартфон</div>
      <div>Биткоин</div>
      <div>Google</div>
      <div>Япония</div>
      <div>США</div>
      <div>Трамп</div>

    </div>
  </div>
</aside>

<script type="text/javascript">
$(function() {
  $( ".tags div" ).click(function() {
    var searchWord = $(this).html();
    window.location.href = "/pages/search.php?words=" + searchWord + "&search_title=on&search_text=on";
  });

  $( "#nightTheme" ).click(function() {
    if ($('#nightTheme').is(':checked')){
        $("#main_css").attr("href", "/css/main_night.css");
        $.post("/set_cookie.php", { NightCheckBox: "yes" } );

    } else {
        $("#main_css").attr("href", "/css/main.css");
        $.post("/set_cookie.php", { NightCheckBox: "no" } );
    }
  });
});
</script>
