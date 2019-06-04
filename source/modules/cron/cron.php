<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
require $_SERVER['DOCUMENT_ROOT'].'/pages/admin/functions/site_parse.php';

$sql_sources = R::getAll("SELECT * FROM sources ORDER BY rand() LIMIT 5");
foreach ($sql_sources as $current_site) {
  SiteParse($current_site['host'], $current_site['item'], $current_site['title'], $current_site['link'], $current_site['text'], $current_site['decode'], $current_site['full_img'], $current_site['category'], $current_site['date']);
}
?>
