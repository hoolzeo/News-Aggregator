<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Админ-панель</title>
  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/meta.php';
 ?>
</head>
<body>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/header.php';
 ?>

  <div class="wrapper container">
    <main>
      <h1>Функции админа</h1>
      <hr>

      <ul>
        <li><a href="news.php">Список новостей</a></li>
        <li><a href="users.php">Список пользователей</a></li>
        <li><a href="comments.php">Список комментариев</a></li>
      </ul>

      <hr>

      <h2>Работа с новостями</h2>
      <button id="CreateSources">Создать базу источников</button>
      <button id="ParsePosts">Добавить новости</button>
      <button id="ParseIcons">Собрать иконки сайтов</button>
      <button id="DownloadImages">Скачать изображения новостей</button>

      <br><br><hr>

      <h2>Очистка</h2>
      <button id="WipeSources">Очистить базу источников</button>
      <button id="WipePosts">Очистить базу постов</button>

      <div id="result"></div>

      <script>
      $("#CreateSources" ).click(function() {
        $.post("functions/add_sources.php", function(data){
          $('#result').html(data);
        });
      });

      $("#DownloadImages" ).click(function() {
        $.post("functions/download_images.php", function(data){
          $('#result').html(data);
        });
      });

      $("#ParseIcons" ).click(function() {
        $.post("functions/add_icons.php", function(data){
          $('#result').html(data);
        });
      });

      $("#ParsePosts" ).click(function() {
        $.post("functions/add_posts.php", function(data){
          $('#result').html(data);
        });
      });

      $("#WipeSources" ).click(function() {
        $.post("functions/wipe.php", { table: "sources"},
        function(data){
          $('#result').html(data);
        });
      });

      $("#WipePosts" ).click(function() {
        $.post("functions/wipe.php", { table: "posts"},
        function(data){
          $('#result').html(data);
        });
      });
      </script>


    </main>

    <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/sidebar.php';
 ?>

  </div>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php';
 ?>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/auth.php';
 ?>

</body>

</html>
