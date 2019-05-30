<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

if(isset($_GET['id'])) {
  $user_id = $_GET['id'];

  $query = R::getAll( 'SELECT * FROM users WHERE id = "'.$user_id.'"' );

  if ($query) {
    foreach ($query as $user) {
      $id = $user['id'];
      $login = $user['login'];
    }
  } else {
    echo 'Данного пользователя не существует';
  }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title><?php echo $login ?></title>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/meta.php'; ?>
</head>
<body>

  <?php
  require $_SERVER['DOCUMENT_ROOT'].'/modules/header.php'; ?>

  <div class="wrapper container">
    <main id="page_viewprofile">

      <h1><?php echo $login ?> (ID: <?php echo $id ?>)</h1>

      <h2>Комментарии пользователя</h2>

      <?php

        $comments = R::getAll( "SELECT * FROM `comments` WHERE `name`='$login' and `auth` = 1 " );
        foreach ($comments as $comment) { ?>
          <div class="comment">
          <div class="comment_top"
          ><b> <?php echo $comment['name']; ?></b> <span class="comm_time"><?php echo str_replace('-','.',$comment['date']) ?></span></div>
          <div class="comment_message_in"><?php echo $comment['message'] ?>
          </div>
          </div>
        <?php } ?>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/sidebar.php'; ?>

  </div>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/auth.php'; ?>

</body>

</html>
