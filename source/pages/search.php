<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

if ( isset($_GET['search_title']) || isset($_GET['search_text']) ) {
  if(isset($_GET['words'])) {

    $search_word = $_GET['words'];

    // Обрезаем окончания у слов для более эффективного поиска
    function DeleteEndings($word) {
        $word = preg_replace("/("."ых|ый|ы|ой|ое|ые|ому|ом|ами|ам|ая|ат|ать|а|овый|ов|ого|ох|о|у|ему|ей|е|ство|ия|ий|и|ять|ь|я|он|ют|".")$/i", "", $word); //удаляем окончания
        return $word;
    }

    $search_word_full = $search_word;

    $search_word = DeleteEndings($search_word);

    $search_title = isset($_GET['search_title']);
    $search_text = isset($_GET['search_text']);

    if (($search_title) and ($search_text)) {
      $query_select = 'SELECT * FROM posts WHERE `title` LIKE "%'.$search_word.'%" OR `text` LIKE "%'.$search_word.'%"';
    } else {
      if ($search_title) $query_select = 'SELECT * FROM posts WHERE `title` LIKE "%'.$search_word.'%"';
      if ($search_text) $query_select = 'SELECT * FROM posts WHERE `text` LIKE "%'.$search_word.'%"';
    }

    $query = R::getAll($query_select);
  }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Поиск по сайту</title>
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
      <div id="search">

      <form method="GET" action="search.php" id="search-wrapper">

      <div class="search-input">
        <input type="text" name="words" placeholder="Что ищем?" <?php if ($search_word_full) echo 'value="'.$search_word_full.'"' ?> required />
        <input type="submit" value="Поиск">
      </div>

      <div class="checkbox-block">
        <div class="checkbox-title">Искать в заголовках</div>
        <div class="checkbox-div"><input type="checkbox" name="search_title" id="search_title" <?php if (($search_title) or (!$search_word)) echo 'checked' ?>></div>
      </div>

      <div class="checkbox-block">
        <div class="checkbox-title">Искать в тексте новости</div>
        <div class="checkbox_div"><input type="checkbox" name="search_text" id="search_text" <?php if ($search_text) echo 'checked' ?>></div>
      </div>

      </form>

      </div>

      <hr />

      <div class="news-list">
<?php
if ($query) {
  foreach ($query as $post) {
    outputImagePost( $post['id'], $post['title'], $post['img'], $post['link']);
  }
}

?>

</div>
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
