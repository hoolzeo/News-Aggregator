<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
?>

<?php
if(isset($_GET['id'])) {
  $comment_id = $_GET['id'];

  $query = R::getAll( 'SELECT * FROM comments WHERE id = "'.$comment_id.'"' );

  if ($query) {
    foreach ($query as $post) {
      $id = $post['id'];
      $name = $post['name'];
      $message = $post['message'];
    }
  } else {
    echo 'Данного комментария не существует';
  }
}

if(isset($_POST['edit_button'])) {
  if($_POST['edd_name_comment'])$edd_name_comment = $_POST['edd_name_comment'];
  if($_POST['edd_message_comment'])$edd_message_comment = $_POST['edd_message_comment'];
  if($_POST['edd_id_comment'])$edd_id_comment = $_POST['edd_id_comment'];

  if($edd_name_comment & $edd_message_comment & $edd_id_comment)
  {
    R::exec( 'UPDATE `comments` SET `name`="' . $edd_name_comment . '", `message`="'.$edd_message_comment.'" WHERE `id` = ' . $edd_id_comment);
    header("Refresh:0; url=/pages/admin/comments.php");
  } else {
    ShowMessage('Заполните все поля!', 'error');
  }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Редактирование комментария</title>
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
      <h1>Редактирование комментария</h1>
      <hr>
      <?php
      echo <<<END
        <form method="post" name="form" id="edit_comment">
          <input name="edd_id_comment" type="hidden" value="$id">
          <input class="form_name" name="edd_name_comment" type="text" value="$name">
          <textarea class="form_text" name="edd_message_comment" rows="10">$message</textarea>
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
