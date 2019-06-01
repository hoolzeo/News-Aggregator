<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

$query = R::getAll( 'SELECT `id`, `img` FROM posts WHERE img != ""' );

PrintArray($query);

foreach ($query as $post) {
  $id = $post['id'];
  $img_url = $post['img'];

  // Название изображения
  $img_filename = $id . '-' .  basename($img_url);

  // Путь на сервере к изображению
  $img_filepath = $_SERVER['DOCUMENT_ROOT'] . "//images//news//" . $img_filename;

  // Проверяем наличие изображения
  if (!file_exists($img_filepath)) {
    // Скачиваем изображение
    downloadFile($img_url, $img_filepath);

    // Заносим в БД название изображения
    $cat = R::load('posts', $id);
    $cat->img_local = $img_filename;
    R::store($cat);
  }
}

?>
