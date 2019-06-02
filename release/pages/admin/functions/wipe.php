<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

if (isset($_POST['table'])) {
  $table = $_POST['table'];

  if ($table == 'sources') {
    R::wipe('sources');
    echo 'База источников удалена!';
  } elseif ($table == 'posts') {
    R::wipe('posts');
    R::wipe('comments');
    echo 'База постов с комментариями удалена!';
  }
}

?>
