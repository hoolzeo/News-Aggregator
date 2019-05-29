<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
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

      <style media="screen">
        #search-wrapper {
          display: flex;
          justify-content: space-between;
          align-items: center;
        }

        .search-input input[name=words] {
          width: 180px;
        }

        .checkbox-block {
          display: flex;
          align-items: center;
        }

        .checkbox-title {
          margin-top: -5px;
          margin-right: 5px;
        }

        .search-input {
          padding: 7px 10px;
          width: 406px;
          border-radius: 2px;
        }
      </style>

      <form method="GET" action="search.php" id="search-wrapper">

      <div class="search-input">
        <input type="text" name="words" placeholder="Что ищем?" required />
        <input type="submit" value="Поиск">
      </div>

      <div class="checkbox-block">
        <div class="checkbox-title">Искать в заголовках</div>
        <div class="checkbox-div"><input type="checkbox" name="search_title" id="search_title" checked></div>
      </div>

      <div class="checkbox-block">
        <div class="checkbox-title">Искать в тексте новости</div>
        <div class="checkbox_div"><input type="checkbox" name="search_text" id="search_text"></div>
      </div>

      </form>

      </div>

      <hr />

      <div class="news-list">

<?php

if ( isset($_GET['search_title']) || isset($_GET['search_title']) ) {
  if(isset($_GET['words'])) {
    $search_word = $_GET['words'];
    $search_title = isset($_GET['search_title']);
    $search_text = isset($_GET['search_text']);

    if (($search_title) and ($search_text)) {
      $query_select = 'SELECT * FROM posts WHERE `title` LIKE "%'.$search_word.'%" OR `text` LIKE "%'.$search_word.'%"';
    } else {
      if ($search_title) $query_select = 'SELECT * FROM posts WHERE `title` LIKE "%'.$search_word.'%"';
      if ($search_text) $query_select = 'SELECT * FROM posts WHERE `text` LIKE "%'.$search_word.'%"';
    }

    $query = R::getAll($query_select);

    foreach ($query as $post) {
      outputImagePost( $post['id'], $post['title'], $post['img'], $post['link']);
    }
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
