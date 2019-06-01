<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
require $_SERVER['DOCUMENT_ROOT'].'/pages/admin/functions/site_parse.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Список новостей</title>
  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/meta.php';
 ?>
</head>
<body>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/header.php';
 ?>

  <div class="wrapper container">
    <main>
      <h1>Добавление новостей</h1>
      <hr>
      <form id="list_sources" method="post">
      <?php
      $sql_sources = R::getAll("SELECT * FROM sources GROUP BY name");
      foreach ($sql_sources as $current_site) {
      	echo '<input type="checkbox" name="source[]" value="'.$current_site['url'].'" /> '.$current_site['url'].'<br />';
      }
      ?>

      <div class="group-buttons">
        <input type="submit" id="select_all" value="Выделить все" />
        <input type="submit" id="unselect_all" value="Снять все" />
      </div>

      <input type="submit" name="GoParseNews" value="Добавить" />

      </form>

      <script type="text/javascript">
      $(function() {
        $('#select_all').click(function(e) {
          e.preventDefault();
          $("#list_sources input[type='checkbox']").attr( "checked" , true );
        });
        $('#unselect_all').click(function(e) {
          e.preventDefault();
          $("#list_sources input[type='checkbox']").attr( "checked" , false );
        });
      });
      </script>

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
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/sidebar.php';
 ?>

  </div>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/footer.php';
 ?>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/auth.php';
 ?>

</body>

</html>
