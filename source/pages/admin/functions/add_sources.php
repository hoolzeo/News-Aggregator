<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

function addsources($url, $name) {
  $sources = R::dispense('sources');
  $havesources = R::count("sources", "url like ?", [$url]);
  if (!$havesources) {
    $sources->url = $url;
    $sources->name = $name;
    R::store($sources);
    echo 'Добавлен источник: <b>' . $name . '</b> ('.$url.')<br>';
  } else {
    echo 'Источник: <b>'.$url . '</b> уже существует.<br>';
  }
}

addsources('vesti.ru', 'Вести');
addsources('bitok.blog', 'Биток Блог');
addsources('bloomchain.ru', 'Bloomchain');
addsources('cryptofeed.ru', 'CryptoFeed');
addsources('rbc.ru', 'РБК');
addsources('vedomosti.ru', 'Ведомости');
addsources('kp.ru', 'Комсомольская правда');
addsources('ria.ru', 'РИА новости');
?>
