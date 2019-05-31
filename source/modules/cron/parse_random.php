<?php
$sql_sources = R::getAll("SELECT * FROM sources ORDER BY rand() LIMIT 1");
foreach ($sql_sources as $current_site) {
  SiteParse($current_site['host'], $current_site['item'], $current_site['title'], $current_site['link'], $current_site['short_img'], $current_site['text'], $current_site['decode'], $current_site['full_img'], $current_site['category']);
}
?>
