<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
?>

<?php
if(isset($_GET['id'])) {
  $news_id = $_GET['id'];

  $query = R::getAll( 'SELECT * FROM posts WHERE id = "'.$news_id.'"' );

  if ($query) {
    foreach ($query as $post) {
      $id = $post['id'];
      $title = $post['title'];
      $text = $post['text'];
    }
  } else {
    echo 'Данной новости не существует';
  }
}

if(isset($_POST['edit_button'])) {
  if($_POST['edd_title_post'])$edd_title_post = $_POST['edd_title_post'];
  if($_POST['edd_text_post'])$edd_text_post = $_POST['edd_text_post'];
  if($_POST['edd_id_post'])$edd_id_post = $_POST['edd_id_post'];

  if($edd_title_post & $edd_text_post & $edd_id_post)
  {
    R::exec( 'UPDATE `posts` SET `title`="' . $edd_title_post . '", `text`="'.$edd_text_post.'" WHERE `id` = ' . $edd_id_post);
    ShowMessage('Новость отредактирована!', 'good');
    header("Refresh:0; url=/pages/view.php?id=$id");
  } else {
    ShowMessage('Заполните все поля!', 'error');
  }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Список новостей</title>
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
      <h1>Редактирование новости</h1>
      <hr>
      <?php
      echo <<<END
        <form method="post" name="form" id="edit_news">
          <input name="edd_id_post" type="hidden" value="$id">
          <input class="form_name" name="edd_title_post" type="text" value="$title">
          <textarea class="form_text" name="edd_text_post" rows="10">$text</textarea>
          <input type="submit" name="edit_button" value="Редактировать">
        </form>
END;
      ?>
      </table>


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
