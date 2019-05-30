<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
?>

<?php
// На всякий случай сразу удаляем комментарии новостей, которых не существует
R::exec('DELETE FROM `comments` WHERE page_id IS NULL');

$countView = 25; // количество материалов на странице

// номер страницы
if(isset($_GET['page'])){
  $pageNum = (int)$_GET['page'];
} else {
  $pageNum = 1;
}
$startIndex = ($pageNum-1)*$countView; // с какой записи начать выборку

// Получаем посты
$sql = R::getAll( "SELECT SQL_CALC_FOUND_ROWS * FROM `comments` ORDER BY id ASC LIMIT $startIndex, $countView");

// получение полного количества новостей
$countAllComments = R::count( 'comments' );

// номер последней страницы
$lastPage = ceil($countAllComments/$countView);

function outputListCommentsAdmin($id, $name, $page_id, $message, $date) {
  // Получаем заголовок новости
  $news = R::load('posts', $page_id);
  $post_title = $news->title;

  // Обрезаем заголовок, если длина больше 60 символов
  if (mb_strlen($post_title) > 60) {
    $post_title = mb_substr($post_title,0,60) . '...';
  }

  $full_message = $message;
  $message = mb_substr($message,0,150) . '...';

  echo <<<END
  <tr id="$id">
    <td class="list_id">$id</td>
    <td class="list_name">$name</td>
    <td class="list_message" title="$full_message">$message</td>
    <td class="list_post"><a target="_blank" href="/pages/view.php?id=$page_id">$post_title</a></td>
    <td class="list_actions">
      <div class="edit" title="Редактировать"><i class="fa fa-cog"></i></div>
      <div class="delete" title="Удалить"><i class="fa fa-trash"></i></div>
  </td>
  </tr>
END;
}
?>

<style media="screen">
  .list_message {
    max-width: 350px;
    word-wrap: break-word;
  }
</style>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Список комментариев</title>
  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/meta.php';
 ?>
</head>
<body>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/header.php';
 ?>

  <div class="wrapper container">
    <main>
      <h1>Список комментариев</h1>
      <hr>

      <div id="result"></div>
      <table id="list">
        <tr>
          <th>ID</th>
          <th>Имя</th>
          <th>Комментарий</th>
          <th>Дата</th>
          <th>Новость</th>
        </tr>
        <?php

        foreach ($sql as $comment) { outputListCommentsAdmin( $comment['id'], $comment['name'], $comment['page_id'], $comment['message'], $comment['date']); } ?>
      </table>

      <script type="text/javascript">
      // Обработчик кнопки "Редактировать"
      $('.edit').click(function() {
          var commentID = $(this).parent().parent().attr('id');
          window.location.href = "http://localhost/pages/admin/edit_comments.php?id=" + commentID;
      });

      // Обработчик кнопки "Удалить"
      $('.delete').click(function() {
          var commentID = $(this).parent().parent().attr('id');
          var isDelete = confirm("Вы уверены, что хотите удалить комментарий?");

          if (isDelete) {
              $.post("functions/record_delete.php", { id: commentID, type: 'comments'},
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
              <li><a href="/pages/admin/comments.php?page=1">&lt;&lt;</a></li>
              <li><a href="/pages/admin/comments.php?page=<?=$pageNum-1;?>">&lt;</a></li>
          <?php } ?>

          <?php for($i = 1; $i<=$lastPage; $i++) { ?>
              <li <?=($i == $pageNum) ? 'class="active"' : '';?>> <a href="/pages/admin/comments.php?page=<?=$i;?>"><?=$i;?></a> </li>
          <?php } ?>

          <?php if($pageNum < $lastPage) { ?>
              <li><a href="/pages/admin/comments.php?page=<?=$pageNum+1;?>">&gt;</a></li>
              <li><a href="/pages/admin/comments.php?page=<?=$lastPage;?>">&gt;&gt;</a></li>
          <?php } ?>
      </ul>

    </main>

    <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/sidebar.php';
 ?>

  </div>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php';
 ?>

  <?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/auth.php';
 ?>

</body>

</html>
