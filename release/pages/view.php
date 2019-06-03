<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/time_read.php';

if(isset($_GET['id'])) {
  $news_id = $_GET['id'];

  $query = R::getAll( 'SELECT * FROM posts WHERE id = "'.$news_id.'"' );

  if ($query) {
    foreach ($query as $post) {
      $title = $post['title'];
      $image = $post['img'];
      $text = $post['text'];
      $link = $post['link'];
    }
  } else {
    header( "HTTP/1.1 404 Not Found" );
    header( "Location: /404.php" );
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title><?php echo $title ?></title>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/meta.php'; ?>
</head>
<body>

  <?php
  require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/header.php'; ?>

  <div class="wrapper container">
    <main id="page_post">

<h1><?php echo $title ?></h1>
<div class="estimated-time"> <i class="fa fa-clock-o"></i> <?php echo "Приблизительное время чтения: " . read_time_estimate($text);?> </div>

<?php if(!empty($image)) { ?>
<div class="post-image"> <img src="<?php echo $image ?>"> </div>
<?php } ?>

<div class="text"><?php
echo $text;
echo '<a href="'.$link.'" target="_blank">Ссылка на источник статьи</a>';
?>

</div>

<div class="comments">

              <h2>Комментарии</h2>
              		<div id="form_comments" >
                    <form name="comment" action="/modules/stuff/add_comment.php" method="post">
                      <div class="forma_inputs">
                        <?php
                        if ( isset ($_SESSION['logged_user']) ) {
                          $userlogin = $_SESSION['logged_user']->login;
                          echo '<input name="auth" type="hidden" value="1">';
                          echo '<input type="text" name="name" value="' . $userlogin . '" readonly maxlength="30">';
                        } else {
                          echo '<input name="auth" type="hidden" value="0">';
                          echo '<input required type="text" name="name" placeholder="Ваше имя" title="Введите Ваше имя" minlength="2" maxlength="30">';
                        }
                        ?>
              					<textarea required name="message" id="cmtx_comment" placeholder="Ваш комментарий .." title="Введите свой комментарий" minlength="10" maxlength="1000"></textarea>
              				</div>
                        <input type="hidden" name="page_id" value="<?php echo $news_id ?>" />
                        <input type="submit" class="btn-blue" value="Добавить комментарий">
                    </form>
              		</div>

<?php

echo $date;

  $page_id = $news_id;// Уникальный идентификатор страницы (статьи или поста)

  $comments = R::getAll( "SELECT * FROM `comments` WHERE `page_id`='$page_id'" );
  foreach ($comments as $comment) { ?>
    <div class="comment">
    <div class="comment_top"><b>
      <?php
      $comment_login = $comment['name'];

      // Это коммент от авторизованного пользователя?
      if ($comment['auth'] == 1) {
        $comment_userID = R::exec('SELECT `id` FROM `users` WHERE `login` = "'.$comment_login.'"');
        echo '<a class="comment_profile_link" href="/pages/cabinet/viewprofile.php?id=' . $comment_userID . ' ">' . $comment_login . '</a>';
      } else {
        echo $comment_login;
      }
    ?></b> <span class="comm_time"><?php echo str_replace('-','.',$comment['date']) ?></span></div>
    <div class="comment_message_in"><?php echo $comment['message'] ?>
    </div>
    </div>
  <?php } ?>

</div>

</main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/sidebar.php'; ?>

  </div>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/chunks/footer.php'; ?>

</body>

</html>
