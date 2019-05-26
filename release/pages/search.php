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
      <div class="bootstrap">

      <form method="GET" action="search.php">
      <input type="text" name="words" placeholder="Что ищем?" required>
      <input type="submit" value="Поиск">
      </form>

      </div>


      <div class="news-list">

<?php

if(isset($_GET['words'])) {
  $search_word = $_GET['words'];
  $query = R::getAll( 'SELECT * FROM posts WHERE `img` IS NOT NULL and  `title` LIKE "%'.$search_word.'%" OR `text` LIKE "%'.$search_word.'%"' );
  foreach ($query as $post) {
    $img = $post['img'];
    if(empty($img)) $img = '/images/noimg.jpg';
    outputImagePost( $post['id'], $post['title'], $img, $post['link']);
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
