<?php
function FuncGetDate($url, $tag, $propName, $propValue, $value) {
  $page = file_get_contents($url); // получаем страницу сайта-донора
  $dom_obj = new DOMDocument();
  $dom_obj->loadHTML($page);
  $meta_val = null;

  foreach($dom_obj->getElementsByTagName($tag) as $meta) {

    if (isset($propName)) {
      if($meta->getAttribute($propName)==$propValue) {
        $meta_val = $meta->getAttribute($value);
      } else {
        $meta_val = $meta->getAttribute($value);

      }
    }

  }
  return $meta_val;
}

//crypto <div class="an-display-time"><i class="fa fa-clock-o"></i> 01.06.2019 09:28</div>
// wek
//vestis
//vz
// iz
// korrespodent

//echo FuncGetDate('https://bitok.blog/post/internet-ombudsmen-prokom', 'time', '', '', 'content');
//echo FuncGetDate('https://eadaily.com/ru/news/2019/05/09/polsha-propitannaya-krovyu-22-mln-sovetskih-grazhdan-ochnis', 'time', 'itemprop', 'datePublished', 'datetime');
//echo FuncGetDate('http://www.aif.ru/money/company/udar_po_rossii_pochemu_transneft_ne_priznayot_viny', 'meta', 'name', 'article:published_time', 'content');
//echo FuncGetDate('https://www.belnovosti.by/sport/glavnoe-video-finala-lch-rydayushchiy-kapitan-liverpulya-vmeste-s-otcom', 'meta', 'property', 'article:published_time', 'content');
//echo FuncGetDate('https://www.vedomosti.ru/economics/news/2019/06/03/803153-rukovoditel-rosstandarta', 'time', 'class', 'pubdate', 'datetime');
//echo FuncGetDate('https://www.kp.ru/daily/26984.5/4044035/', 'time', 'class', 'timeRegionJS', 'datetime');
//echo FuncGetDate('https://www.interfax.ru/russia/663464', 'meta', 'itemprop', 'datePublished', 'content');
//echo FuncGetDate('https://sportrbc.ru/news/5cf40ae49a794782dc959225?ruid=UET9A1y5sPo7uHE9AxzcAg==&from=from_main', 'span', 'itemprop', 'datePublished', 'content');
//echo FuncGetDate('https://ru.tsn.ua/ukrayina/troica-i-den-konstitucii-skolko-vyhodnyh-poluchat-ukraincy-v-iyune-1355817.html', 'meta', 'property', 'article:published', 'content');


?>
