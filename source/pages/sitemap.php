<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>

  <title>Список источников новостей</title>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/meta.php';
 ?>
</head>
<body>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/header.php';
 ?>

  <div class="wrapper container">
    <main id="sources">
      <h1>Список источников новостей</h1>


<div class="text">
  <h2>Блокчейн и криптовалюта:</h2>
  <ul>
    <?php
    $sql_sources = R::getAll("SELECT * FROM sources WHERE category = 'Блокчейн' GROUP BY name ORDER BY name DESC");
    foreach ($sql_sources as $current_site) {
      echo '<li><b>'.$current_site['name'].'</b> - <a href="'.$current_site['host'].'">'.$current_site['host'].'</a></li>';
    }
    ?>
  </ul>

  <h2>Общетематические новостные сайты:</h2>
  <ul>
    <?php
    $sql_sources = R::getAll("SELECT * FROM sources WHERE category = '' GROUP BY name ORDER BY name DESC");
    foreach ($sql_sources as $current_site) {
      echo '<li><b>'.$current_site['name'].'</b> - <a href="'.$current_site['host'].'">'.$current_site['host'].'</a></li>';
    }
    ?>
  </ul>
  <p>В данный момент список активно пополняется.</p>

  <h2>Ведётся работа над подключением следующих источников:</h2>
  <ol>
    <li>https://iz.ru/</li>
    <li>https://lenta.ru/</li>
    <li>https://rg.ru/</li>
    <li>https://www.rbc.ru/</li>
    <li>https://www.mk.ru/</li>
    <li>https://www.gazeta.ru/</li>
    <li>http://www.aif.ru/</li>
    <li>https://www.kommersant.ru/</li>
    <li>https://tass.ru/</li>
    <li>https://life.ru/</li>
    <li>https://24smi.org/</li>
    <li>https://vz.ru/</li>
    <li>https://regnum.ru/</li>
    <li>https://inosmi.ru/</li>
    <li>https://echo.msk.ru/</li>
    <li>https://www.lentainform.com/</li>
    <li>https://www.fontanka.ru/</li>
    <li>http://argumenti.ru/</li>
    <li>https://www.belnovosti.by/</li>
    <li>https://news.ru/</li>
    <li>https://korrespondent.net/</li>
    <li>https://www.vedomosti.ru/</li>
    <li>https://rusvesna.su/</li>
    <li>https://medialeaks.ru/</li>
    <li>https://eadaily.com/ru/</li>
    <li>https://www.novayagazeta.ru/</li>
    <li>https://nevnov.ru/</li>
    <li>https://www.interfax.ru/</li>
    <li>https://newzfeed.ru/</li>
    <li>https://www.znak.com/</li>
    <li>http://wek.ru/</li>
    <li>http://www.rosbalt.ru/</li>
    <li>https://meduza.io/</li>
    <li>https://news.yandex.ru/</li>
    <li>https://news.mail.ru/</li>
    <li>https://news.rambler.ru/</li>
  </ol>

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
