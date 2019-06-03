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
  <ol id="kek">
    <li>https://rg.ru/</li>
    <li>https://www.gazeta.ru/</li>
    <li>https://regnum.ru/</li>
    <li>https://echo.msk.ru/</li>
    <li>https://www.fontanka.ru/</li>
    <li>http://argumenti.ru/</li>
    <li>https://news.ru/</li>
    <li>https://www.novayagazeta.ru/</li>
    <li>https://nevnov.ru/</li>
    <li>https://www.znak.com/</li>
    <li>https://meduza.io/</li>
    <li>https://www.bbc.com/russian</li>
    <li>https://www.bfm.ru/</li>
    <li>https://svpressa.ru/</li>
    <li>https://russian.rt.com/</li>
  </ol>
</div>

<script type="text/javascript">
  $('#kek').find('li').each(function() {
      var url = $(this).text();
      $(this).html('<a href="' + url + '"> ' + url + ' </a> ');
		});
</script>


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
