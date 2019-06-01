<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

$countView = 50; // количество материалов на странице

// номер страницы
if(isset($_GET['page'])){
  $pageNum = (int)$_GET['page'];
} else {
  $pageNum = 1;
}
$startIndex = ($pageNum-1)*$countView; // с какой записи начать выборку

// Получаем посты
$sql = R::getAll( "SELECT SQL_CALC_FOUND_ROWS * FROM `posts` ORDER BY id DESC LIMIT $startIndex, $countView");

// получение полного количества новостей
$countAllNews = R::count( 'posts' );

// номер последней страницы
$lastPage = ceil($countAllNews/$countView);

function outputListAdmin($id, $source, $image, $title, $source_link, $text) {
  $source_echo = GetRootUrl($source);

  echo <<<END
  <tr id="$id">
    <td class="list_id">$id</td>
    <td class="list_source"><div class="source-icon"><img title="$source_echo" src="/images/icons/sites/16/$source_echo.ico"></div></td>
    <td class="list_image"><img src="$image"></td>
    <td class="list_title"><a target="_blank" href="/pages/view.php?id=$id">$title</a></td>
    <td class="list_link"><a href="$source_link" target="_blank"><i class="fa fa-external-link"></i></a></td>
    <td class="list_actions">
      <div class="edit" title="Редактировать"><i class="fa fa-cog"></i></div>
      <div class="delete" title="Удалить"><i class="fa fa-trash"></i></div>
  </td>
  </tr>
END;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Список новостей</title>
  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/meta.php';
 ?>
</head>
<body>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/header.php';
 ?>

  <div class="wrapper container">
    <main>
      <h1>Список новостей</h1>
      <hr>
      <table id="list">
        <tr>
          <th>ID</th>
          <th>Источник</th>
          <th>Изображение</th>
          <th>Заголовок</th>
          <th>Ссылка на источник</th>
          <th>Действия</th>
        </tr>
        <?php
        foreach ($sql as $post) { outputListAdmin( $post['id'], $post['link'], $post['img'], $post['title'], $post['link'], $post['text']); } ?>
      </table>

      <script type="text/javascript">
      // Обработчик кнопки "Редактировать"
      $('.edit').click(function() {
          var newsID = $(this).parent().parent().attr('id');
          window.location.href = "/pages/admin/edit_news.php?id=" + newsID;
      });

      // Обработчик кнопки "Удалить"
      $('.delete').click(function() {
          var newsID = $(this).parent().parent().attr('id');
          var isDelete = confirm("Вы уверены, что хотите удалить новость?");

          if (isDelete) {
              $.post("functions/record_delete.php", { id: newsID, type: 'news'},
              function(data){
                alert(data);
                location.reload();
          });
        }
      });
      </script>

      <!-- вывод пагинатора -->
      <ul class="pagination">
          <?php if($pageNum > 1) { ?>
              <li><a href="/pages/admin/news.php?page=1">&lt;&lt;</a></li>
              <li><a href="/pages/admin/news.php?page=<?=$pageNum-1;?>">&lt;</a></li>
          <?php } ?>

          <?php for($i = 1; $i<=$lastPage; $i++) { ?>
              <li <?=($i == $pageNum) ? 'class="active"' : '';?>> <a href="/pages/admin/news.php?page=<?=$i;?>"><?=$i;?></a> </li>
          <?php } ?>

          <?php if($pageNum < $lastPage) { ?>
              <li><a href="/pages/admin/news.php?page=<?=$pageNum+1;?>">&gt;</a></li>
              <li><a href="/pages/admin/news.php?page=<?=$lastPage;?>">&gt;&gt;</a></li>
          <?php } ?>
      </ul>

    </main>

    <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/sidebar.php';
 ?>

  </div>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/footer.php';
 ?>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/auth.php';
 ?>

</body>

</html>
