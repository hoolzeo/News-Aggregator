<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
require $_SERVER['DOCUMENT_ROOT'].'/pages/admin/functions/site_parse.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Список новостей</title>
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
      <h1>Добавление новостей</h1>
      <hr>
      <form method="post">
      <?php
      $sql_sources = R::getAll("SELECT * FROM sources GROUP BY name");
      foreach ($sql_sources as $current_site) {
      	echo '<input type="checkbox" name="source[]" value="'.$current_site['url'].'" /> '.$current_site['url'].'<br />';
      }
      ?>
      <input type="submit" name="GoParseNews" value="Добавить" />
      <input type="reset" value="Снять все отметки" />
      </form>

      <br><hr>

      <?php
      // Получаем выделенные чекбоксы и парсим эти сайты
      if (isset($_POST['GoParseNews'])) {
        $sourceList = $_POST['source'];
        if(!empty($sourceList)) {
          $N = count($sourceList);
          for ($i=0; $i < $N; $i++) {
            $sourceURL = $sourceList[$i];

            $sql_sources = R::getAll('SELECT * FROM sources WHERE `url` = "'. $sourceURL. '"');

            foreach ($sql_sources as $current_site) {
              SiteParse($current_site['host'], $current_site['item'], $current_site['title'], $current_site['link'], $current_site['short_img'], $current_site['text'], $current_site['decode'], $current_site['full_img'], $current_site['category']);
            }
          }
        } else {
          ShowMessage('Вы не выбрали ни одного источника.', 'error');
        }
      }
      ?>

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
