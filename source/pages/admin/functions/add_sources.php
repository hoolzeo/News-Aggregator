<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
require $_SERVER['DOCUMENT_ROOT'].'/modules/source_marks.php';

//R::wipe('sources');

function MarksDB($host, $url, $name, $item, $prev_title, $prev_link, $prev_img, $post_text, $if_decode, $post_image = null, $category = null)
{
  $msg_icon = null;

  // Добавляем источник в БД
  $sources = R::dispense('sources');
  $sources->host = $host;
  $sources->url = $url;
  $sources->name = $name;
  $sources->item = $item;
  $sources->title = $prev_title;
  $sources->link = $prev_link;
  $sources->short_img = $prev_img;
  $sources->text = $post_text;
  $sources->decode = $if_decode;
  $sources->full_img = $post_image;
  $sources->category = $category;
  R::store($sources);

  // Скачиваем иконку, если её нет на сервере
  $faviconUrl = 'https://www.google.com/s2/favicons?domain='.$url;
  $filePath = $_SERVER['DOCUMENT_ROOT'] . '/images/icons/sites/16/'.$url.'.ico';

  if (!file_exists($filePath)) {
    file_put_contents($filePath, file_get_contents($faviconUrl));
    $msg_icon = ' и загружена иконка';
  }

  echo 'Добавлен источник: <b>' . $name . '</b> ('.$url.') '.$msg_icon.' <br>';
}

foreach ($marks as $current_site) {
  $url = GetRootUrl($current_site['host']);
  MarksDB($current_site['host'], $url, $current_site['name'], $current_site['item'], $current_site['title'], $current_site['link'], $current_site['short_img'], $current_site['text'], $current_site['decode'], $current_site['full_img'], $current_site['category']);
}
?>
