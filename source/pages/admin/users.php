<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
?>

<?php
$countView = 25; // количество материалов на странице

// номер страницы
if(isset($_GET['page'])){
  $pageNum = (int)$_GET['page'];
} else {
  $pageNum = 1;
}
$startIndex = ($pageNum-1)*$countView; // с какой записи начать выборку

// Получаем пользователей
$sql = R::getAll( "SELECT SQL_CALC_FOUND_ROWS * FROM `users` ORDER BY id ASC LIMIT $startIndex, $countView");

// получение полного количества пользователей
$countAllNews = R::count( 'users' );

// номер последней страницы
$lastPage = ceil($countAllNews/$countView);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Список пользователей</title>
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
      <h1>Список пользователей</h1>
      <hr>
      <table id="list">
        <tr>
          <th>ID</th>
          <th>Имя пользователя</th>
          <th>Количество комментариев</th>
          <th>Действия</th>
        </tr>
        <?php

        foreach ($sql as $user) {

          $id = $user['id'];
          $login = $user['login'];
          $num_comms = R::exec( "SELECT SQL_CALC_FOUND_ROWS * FROM `comments` WHERE name = 'admin' and auth = 1" );

          echo <<<END
          <tr id="$id">
            <td class="list_id">$id</td>
            <td class="list_name"><a href="http://localhost/pages/cabinet/viewprofile.php?id=$id" target="_blank">$login</a></td>
            <td class="list_count_comms">$num_comms</td>
            <td class="list_actions">
              <div class="edit" title="Редактировать"><i class="fa fa-cog"></i></div>
              <div class="delete" title="Удалить"><i class="fa fa-trash"></i></div>
          </td>
          </tr>
END;
        }
        ?>
      </table>

      <script type="text/javascript">
      // Обработчик кнопки "Редактировать"
      $('.edit').click(function() {
          var newsID = $(this).parent().parent().attr('id');
          window.location.href = "http://localhost/pages/admin/edit_news.php?id=" + newsID;
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
              <li><a href="/pages/admin/users.php?page=1">&lt;&lt;</a></li>
              <li><a href="/pages/admin/users.php?page=<?=$pageNum-1;?>">&lt;</a></li>
          <?php } ?>

          <?php for($i = 1; $i<=$lastPage; $i++) { ?>
              <li <?=($i == $pageNum) ? 'class="active"' : '';?>> <a href="/pages/admin/users.php?page=<?=$i;?>"><?=$i;?></a> </li>
          <?php } ?>

          <?php if($pageNum < $lastPage) { ?>
              <li><a href="/pages/admin/users.php?page=<?=$pageNum+1;?>">&gt;</a></li>
              <li><a href="/pages/admin/users.php?page=<?=$lastPage;?>">&gt;&gt;</a></li>
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
