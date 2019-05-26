<?php
function getSourceInfo($source, $column) {
	$sources = R::getAll( 'SELECT * FROM sources' );
  foreach ($sources as $item) {
    if (isHaveText($source, $item['url'])) {
			return $item[$column];
    }
  }
}

function outputLinksPost($id, $title, $source) {
  echo '<li><a href="/pages/view.php?id='.$id.'">';
	echo '<div class="source-icon"><img src="/images/icons/sites/16/'.GetRootUrl($source).'.ico"></div>';
  echo '    <div class="title">'.$title.'</div>';
  echo '  </a></li>';
}

function outputImagePost($id, $title, $img, $source) {
  echo '<div class="cart">';
  echo '<div class="cart-image">';
  echo '<a href="/pages/view.php?id='.$id.'"><img src="'.$img.'"></a>';
	echo '<div class="source">'.getSourceInfo($source, 'name').'</div>';
  echo '   </div>';
  echo '   <div class="cart-title done"><a href="/pages/view.php?id='.$id.'">'.$title.'</a></div>';
  echo '   </div>';
}
?>
