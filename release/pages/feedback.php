<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Обратная связь</title>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/meta.php';
 ?>
</head>
<body>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/header.php';
 ?>

  <div class="wrapper container">
    <main id="feedback">
      <h1>Обратная связь</h1>

      <p>Если Вы заметили на сайте ошибку, мы будем рады получить о ней информацию. Обещаем, исправить как можно быстрее.</p>

      <div class="text">
        <b>Способы связи:</b>
        <ul>
          <li><a class="link-blue" target="_blank" href="https://t.me/hoolz">Телеграм</a></li>
          <li><a class="link-blue" target="_blank" href="https://vk.com/hoolz">ВКонтакте</a></li>
        </ul>
      </div>

    </main>

    <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/sidebar.php';
 ?>

  </div>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/footer.php';
 ?>

</body>

</html>
