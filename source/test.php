<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
require $_SERVER['DOCUMENT_ROOT'].'/modules/source_marks.php';

R::wipe('sources');

function MarksDB($host, $url, $name, $item, $prev_title, $prev_link, $prev_img, $post_text, $if_decode, $post_image = null, $category = null)
{
  $sources = R::dispense('sources');
  $sources->host = $host;
  $sources->url = $url;
  $sources->name = $name;
  $sources->item = $item;
  $sources->prev_title = $prev_title;
  $sources->prev_link = $prev_link;
  $sources->prev_img = $prev_img;
  $sources->post_text = $post_text;
  $sources->if_decode = $if_decode;
  $sources->post_image = $post_image;
  $sources->category = $category;
  R::store($sources);
  echo 'Добавлен источник: <b>' . $name . '</b> ('.$url.')<br>';
}

foreach ($marks as $current_site) {
  $url = str_replace('www.', '', parse_url($current_site['host'], PHP_URL_HOST));
  MarksDB($current_site['host'], $url, $current_site['name'], $current_site['item'], $current_site['title'], $current_site['link'], $current_site['short_img'], $current_site['text'], $current_site['decode'], $current_site['full_img'], $current_site['category']);
}
?>
