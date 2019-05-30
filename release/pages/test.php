<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
require $_SERVER['DOCUMENT_ROOT'].'/modules/Corrector.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>

  <title>Список источников новостей</title>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/meta.php';
 ?>
</head>
<body>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/header.php';
 ?>

  <div class="wrapper container">
    <main id="sources">
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
