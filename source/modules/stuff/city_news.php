<?php
if(isset($_GET['url'])) {
    $get_url = $_GET['url'];
}

function getFeeds($url) {
  $content = file_get_contents($url);
  $items = new SimpleXmlElement($content);
   foreach($items -> channel -> item as $item) {
    print "<li><a href = '{$item->link}' title = '$item->title'> <div class='title'>" .
    $item->title . "</div></a> </li>";
   }
  }

  getFeeds($get_url);
?>
