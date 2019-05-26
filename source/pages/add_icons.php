<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

$query = R::getAll( 'SELECT `link` FROM posts' );
foreach ($query as $post) {
  $rootUrl = GetRootUrl($post['link']);

  $faviconUrl = 'https://www.google.com/s2/favicons?domain='.$rootUrl;

  $filePath = $_SERVER['DOCUMENT_ROOT'] . '/images/icons/sites/16/'.$rootUrl.'.ico';

  if (!file_exists($filePath)) {
    file_put_contents($filePath, file_get_contents($faviconUrl));
  }

}
?>
