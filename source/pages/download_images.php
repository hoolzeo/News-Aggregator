<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

$query = R::getAll( 'SELECT `id`, `img` FROM posts ' );

foreach ($query as $post) {
  $id = $post['id'];
  $img_url = $post['img'];

  $img_filename = $id . '-' .  basename($img_url);
  $img_filepath = $_SERVER['DOCUMENT_ROOT'] . "//images//news//" . $img_filename;

  downloadFile($img_url, $img_filepath);

  $cat = R::load('posts', $id);
  $cat->img_local = $img_filename;
  R::store($cat);
}

?>
