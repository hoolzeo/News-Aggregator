<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
require $_SERVER['DOCUMENT_ROOT'].'/modules/guard_admin.php';

if (isset($_POST['id']) and isset($_POST['type'])) {
  $recordID = $_POST['id'];

  // Удаление новости
  if ($_POST['type'] == 'news') {
    $newsRemove = R::load('posts', $recordID);
    R::trash($newsRemove);

    // Удаляем комментарии к этой новости
    R::exec('DELETE FROM `comments` WHERE page_id = ' . $recordID);

    $checkDelete = R::findOne('posts', 'id = ?', [$recordID]);
    if (empty($checkDelete)) {
      echo 'Новость успешно удалена';
    } else {
      echo 'Ошибка';
    }
  }

  // Удаление комментария
  if ($_POST['type'] == 'comments') {
    $commentRemove = R::load('comments', $recordID);
    R::trash($commentRemove);

    $checkDelete = R::findOne('comments', 'id = ?', [$recordID]);
    if (empty($checkDelete)) {
      echo 'Комментарий успешно удалён';
    } else {
      echo 'Ошибка';
    }
  }
}
?>
