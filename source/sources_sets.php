<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

// Получаем выделенные чекбоксы и сохраняем в куки
if (isset($_POST['SaveListSources'])) {
  $sourceList = $_POST['source'];
  if (count($sourceList) > 0) {
    Setcookie("allow_sources", serialize($sourceList));
    header('Location: / ');
  } else {
    ShowMessage('Выберите хотя бы один источник!');
  }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>

  <title>Фильтр ленты</title>

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
      <h1>Фильтр ленты</h1>
      <hr>

      <form id="list_sources" method="post">
      <?php
      $sql_sources = R::getAll("SELECT * FROM sources GROUP BY name");

      if (isset($_COOKIE['allow_sources'])) $get_sources = unserialize($_COOKIE['allow_sources']);

      foreach ($sql_sources as $current_site) {
        if ((in_array($current_site['url'], $get_sources)) or $emptyCookie) $checked = 'checked';
        echo '<input type="checkbox" name="source[]" '.$checked.' value="'.$current_site['url'].'" /> '.$current_site['url'].'<br />';
        $checked = null;
      }
      ?>

      <div class="group-buttons">
        <input type="submit" id="select_all" value="Выделить все" />
        <input type="submit" id="unselect_all" value="Снять все" />
      </div>

      <input type="submit" name="SaveListSources" value="Сохранить" />

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
