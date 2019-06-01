<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

$page_title = 'Главная страница';

$countView = 15; // количество материалов на странице

// номер страницы
if(isset($_GET['page'])){
  $pageNum = (int)$_GET['page'];
} else {
  $pageNum = 1;
}
$startIndex = ($pageNum-1)*$countView; // с какой записи начать выборку

if (($userlogin) and (!empty($stop_words_string))) {
  $query_parts = array();
  foreach ($stop_words as $val) {
      $query_parts[] = "'%".$val."%'";
  }

  $AndStopNotLike = implode(' and title NOT LIKE ', $query_parts);

  $sql = R::getAll( "SELECT SQL_CALC_FOUND_ROWS * FROM `posts` WHERE img != '' AND title NOT LIKE {$AndStopNotLike} ORDER BY id DESC LIMIT $startIndex, $countView");
  $countAllNews = R::count( 'posts', "WHERE img != '' AND title NOT LIKE {$AndStopNotLike}");
  $expressNews = R::getAll( "SELECT * FROM posts WHERE img IS NULL AND title NOT LIKE {$AndStopNotLike} ORDER BY id DESC LIMIT 5" );

} else {
  $sql = R::getAll( "SELECT SQL_CALC_FOUND_ROWS * FROM `posts` WHERE img != '' ORDER BY id DESC LIMIT $startIndex, $countView");
  $countAllNews = R::count( 'posts', "WHERE img != ''");
  $expressNews = R::getAll( 'SELECT * FROM posts WHERE img IS NULL ORDER BY id DESC LIMIT 5' );
}

// номер последней страницы
$lastPage = ceil($countAllNews/$countView);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title><?php echo $page_title ?></title>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/meta.php'; ?>

</head>
<body>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/header.php'; ?>

  <div class="wrapper container">
    <main>
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" charset="utf-8"></script>

      <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }

      toastr.error('I do not think that word means what you think it means.', 'Ошибка');

      </script>

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
            foreach ($expressNews as $post) { outputLinksPost( $post['id'], $post['title'], $post['link']); }
          ?>
        </ul>
      </div>

      <h1>Главные новости за сегодня</h1>
      <div class="news-list">
        <!-- вывод новостей -->
        <?php foreach($sql as $post) {

          $image = $post['img'];

          // Проверяем есть ли локальное изображение
          if (isset($post['img_local'])) {
            $img_local = $_SERVER['DOCUMENT_ROOT'] . "//images//news//" . $post['img_local'];
            if (file_exists($img_local)) {
              $image = $post['img_local'];
            }
          }

          // Если изображение не из интернета, подставляем адрес локальной папки
          if ((!isHaveText($image, 'http')) and (substr($image, 0, 2) != '//')) {
            $image = '/images/news/' . $image;
          }

          outputImagePost( $post['id'], $post['title'], $image, $post['link']);
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

    <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/sidebar.php'; ?>

  </div>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/footer.php'; ?>

</body>

</html>
