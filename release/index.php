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

// Стоп-слова для авторизованных пользователей
if (($userlogin) and (!empty($stop_words_string))) {
  $query_parts = array();
  foreach ($stop_words as $val) $query_parts[] = "'%".trim($val)."%'";
  $AndStopNotLike = implode(' and title NOT LIKE ', $query_parts);
  $filter_stopwords = "and (title NOT LIKE {$AndStopNotLike})";
}

// Формируем ленту
$tmpArray = [];
$test_array = [];

if (count(unserialize($_COOKIE['allow_sources'])) <= 1) {
  $sql_sources = R::getAll("SELECT `url` FROM sources GROUP BY name");
  foreach ($sql_sources as $current_site) array_push($test_array, $current_site['url']);  // Костыль
  $sql_sources = $test_array;
} else {
  $sql_sources = unserialize($_COOKIE['allow_sources']);
}

foreach ($sql_sources as $current_site) {
  array_push($tmpArray, "'%".$current_site."%'");
}

$AndSourceLike = implode(' or link LIKE ', $tmpArray);
$filter_link = "link LIKE {$AndSourceLike}";

$zapros = "SELECT SQL_CALC_FOUND_ROWS * FROM `posts` WHERE id IN (SELECT id FROM posts WHERE {$filter_link}) {$filter_stopwords} and `img` IS NOT NULL ORDER BY id DESC LIMIT $startIndex, $countView";

$sql = R::getAll($zapros);

$countAllNews = R::count( 'posts', "WHERE id IN (SELECT id FROM posts WHERE {$filter_link}) {$filter_stopwords} and `img` IS NOT NULL");
$expressNews = R::getAll( "SELECT * FROM posts WHERE id IN (SELECT id FROM posts WHERE {$filter_link}) {$filter_stopwords} and `img` IS NULL ORDER BY id DESC LIMIT 5" );

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
              <li><a href="/index.php?page=<?=$pageNum-1;?>">Назад</a></li>
          <?php } ?>

          <?php if($pageNum < $lastPage) { ?>
              <li><a href="/index.php?page=<?=$pageNum+1;?>">Вперёд</a></li>
              <li><a href="/index.php?page=<?=$lastPage;?>">&gt;&gt;</a></li>
          <?php } ?>
      </ul>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/sidebar.php'; ?>

  </div>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/footer.php'; ?>

</body>

</html>
