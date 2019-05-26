<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
?>

<?php
$countView = 15; // количество материалов на странице

// номер страницы
if(isset($_GET['page'])){
  $pageNum = (int)$_GET['page'];
} else {
  $pageNum = 1;
}
$startIndex = ($pageNum-1)*$countView; // с какой записи начать выборку

// Получаем посты
$sql = R::getAll( "SELECT SQL_CALC_FOUND_ROWS * FROM `posts` WHERE img != '' ORDER BY id DESC LIMIT $startIndex, $countView");

// получение полного количества новостей
$countAllNews = R::count( 'posts', "WHERE img != ''");

// номер последней страницы
$lastPage = ceil($countAllNews/$countView);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/meta.php'; ?>
</head>
<body>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/header.php'; ?>

<?php

?>

  <div class="wrapper container">
    <main>

      <div class="news-list2" id="test" style="display: none">
        <div class="block-title">Новости <div class="title-city"><a href="#"><div id="city"></div></a></div> </div>

        <div id="spinner" class="lds-css ng-scope">
          <div class="lds-spinner" style="width:100%;height:100%"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <ul></ul>
      </div>

      <div id="express_news" class="news-list2">
        <div class="block-title">Экспресс-новости</div>
        <ul>
          <?php
            $query = R::getAll( 'SELECT * FROM posts WHERE img IS NULL ORDER BY id DESC LIMIT 5' );
            foreach ($query as $post) { outputLinksPost( $post['id'], $post['title'], $post['link']); }
          ?>
        </ul>
      </div>


      <h1>Главные новости за сегодня</h1>

      <div class="news-list">
        <!-- вывод новостей -->
        <?php foreach($sql as $post) {
          outputImagePost( $post['id'], $post['title'], $post['img'], $post['link']);
        }
        ?>

      </div>

      <!-- вывод пагинатора -->
      <ul class="pagination">
          <?php if($pageNum > 1) { ?>
              <li><a href="/index.php?page=1">&lt;&lt;</a></li>
              <li><a href="/index.php?page=<?=$pageNum-1;?>">&lt;</a></li>
          <?php } ?>

          <?php for($i = 1; $i<=$lastPage; $i++) { ?>
              <li <?=($i == $pageNum) ? 'class="active"' : '';?>> <a href="/index.php?page=<?=$i;?>"><?=$i;?></a> </li>
          <?php } ?>

          <?php if($pageNum < $lastPage) { ?>
              <li><a href="/index.php?page=<?=$pageNum+1;?>">&gt;</a></li>
              <li><a href="/index.php?page=<?=$lastPage;?>">&gt;&gt;</a></li>
          <?php } ?>
      </ul>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/sidebar.php'; ?>

  </div>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/auth.php'; ?>

</body>

</html>
