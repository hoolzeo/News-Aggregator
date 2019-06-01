<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

$query = R::getAll( 'SELECT `id`, `img` FROM posts WHERE img != ""' );

foreach ($query as $post) {
  $id = $post['id'];
  $img_url = $post['img'];

  // Название изображения
  $img_filename = $id . '-' .  basename($img_url);

  // Расширение изображения
  $img_extension = pathinfo($img_url, PATHINFO_EXTENSION);

  // Обрезаем лишние символы
	$bad_symbols = array('.', '"', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', ';', "'", ',', '/', '', '~', '`', '=');
	$img_filename = str_replace($bad_symbols, '', $img_filename);

  // Вырезаем расширение
  $img_filename = str_replace($img_extension, '', $img_filename);

  // Обрезаем слишком длинные названия
  $img_filename = substr($img_filename, 0, 25);

  // Подставляем расширение
  $img_filename = $img_filename . '.' . $img_extension;

  // Путь на сервере к изображению
  $img_filepath = $_SERVER['DOCUMENT_ROOT'] . "//images//news//" . $img_filename;

  // Проверяем наличие изображения
  if (!file_exists($img_filepath)) {
    // Скачиваем изображение
    downloadFile($img_url, $img_filepath);

    echo '<b>Добавлено изображение:</b> ' . $img_filename . '<br>';

    // Заносим в БД название изображения
    $cat = R::load('posts', $id);
    $cat->img_local = $img_filename;
    R::store($cat);
  }
}

?>
