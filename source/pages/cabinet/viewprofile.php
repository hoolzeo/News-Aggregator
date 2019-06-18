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
    header( "HTTP/1.1 404 Not Found" );
    header( "Location: /404.php" );
    exit();
  }
}

if (isset($_POST['StopWords_btn'])) {
  if($_POST['StopWords_input']) $StopWords_input = $_POST['StopWords_input'];

  R::exec( 'UPDATE `users` SET `stop_words`="' . $StopWords_input . '" WHERE `id` = ' . $userID);
  header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title><?php echo $login ?></title>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/meta.php'; ?>
</head>
<body>

  <?php
  require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/header.php'; ?>

  <div class="wrapper container">
    <main id="page_viewprofile">

      <h1><?php echo $login ?> (ID: <?php echo $id ?>)</h1>

      <?php
      if ($user_id == $userID) {
        echo <<<END
        <hr>
        <h2>Стоп-слова для новостей</h2>
        <p>Вы можете отключить отображение новостей, в <b>заголовках</b> которых содержатся стоп-слова.<br>Для этого введите слова в поле через пятую.</p>
        <p><i>Например: путин, санкции, футбол</i></p>
        <style media="screen">
          input[name=StopWords_input] {
            width: 410px;
            padding: 2px 3px;
          }
        </style>
        <form method="post">
          <input type="text" name="StopWords_input" placeholder="Какие новости будем игнорировать?" value="$stop_words_string">
          <input type="submit" name="StopWords_btn" value="ОК">
        </form>
END;
      }
?>

      <br><hr>

      <h2>Комментарии пользователя</h2>
      <?php
        $comments = R::getAll( "SELECT * FROM `comments` WHERE `name`='$login' and `auth` = 1 " );

        foreach ($comments as $comment) { ?>
          <?php
            $page_id = $comment['page_id'];
            $sql_post = R::getAll( "SELECT `title` FROM `posts` WHERE `id`='$page_id'" );
            $page_title = $sql_post[0]['title'];
          ?>
          <div class="comment">
          <div class="comment_top"
          ><b> <?php echo $comment['name']; ?></b> <span class="comm_time"><?php echo str_replace('-','.',$comment['date']) ?></span></div>
          <div class="comment_message_in"><?php echo $comment['message'] ?></div>

          <div class="comment_link_post">Новость: <a class="link-blue" href="/pages/view.php?id=<?php echo $page_id ?>"><?php echo $page_title ?></a></div>
          </div>
        <?php } ?>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/sidebar.php'; ?>

  </div>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/footer.php'; ?>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/auth.php'; ?>

</body>

</html>
