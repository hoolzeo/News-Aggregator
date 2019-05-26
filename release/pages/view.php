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
    }
  } else {
    echo 'Данной новости не существует';
  }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title><?php echo $title ?></title>
  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/meta.php'; ?>
</head>
<body>

  <?php
  require $_SERVER['DOCUMENT_ROOT'].'/modules/header.php'; ?>

  <div class="wrapper container">
    <main>

<h1><?php echo $title ?></h1>
<div class="estimated-time"> <i class="fa fa-clock-o"></i> <?php echo "Приблизительное время чтения: " . read_time_estimate($text);?> </div>

<?php if(!empty($image)) { ?>
<div class="post-image"> <img src="<?php echo $image ?>"> </div>
<?php } ?>


<div class="text"><?php echo $text ?></div>

<div class="comments">

              <h2>Комментарии</h2>
              		<div id="form_comments" >
                    <form name="comment" action="modules/stuff/comment.php" method="post">
                      <div class="forma_inputs">
              					<input required type="text" name="name" placeholder="Ваше имя" title="Введите Ваше имя" maxlength="30">
              					<textarea required name="message" id="cmtx_comment" placeholder="Ваш комментарий .." title="Введите свой комментарий" maxlength="1000"></textarea>
              				</div>
                        <input type="hidden" name="page_id" value="<?php echo $news_id ?>" />
                        <input type="submit" class="btn-blue" value="Добавить комментарий">
                    </form>
              		</div>

                	<div class="comment_over" hidden>
              		<div class="comment">
              			<div class="comment_avatar"><img src="https://pp.userapi.com/c840637/v840637531/129c3/0h3rRFSpGAw.jpg" width="64" alt="" /></div>
              			<div class="comment_message">
              				<div class="comment_top"><a href="javascript://" rel="nofollow" onclick="window.open('/index/8-1481', 'up1481', 'scrollbars=1,top=0,left=0,resizable=1,width=700,height=375'); return false;">nikitka530</a> <span class="comm_time">12.08.2017 в 19:25</span></div>
              				<div class="comment_message_in">Эмка падение икара есть в дефолтном виде,на gаmеbаnana точка cоm крч там красиво сделано,но тебе придется поискать там,там же много файлов и мусора,найди тот самый и качай! А вот калаш красная линия есть,но я забыл где,тоже в дефолтном виде,есть даже с наклейками Астралис! Там надпись dev1ce написано,крч очень крутой! Поищи в интернете "Cs 1.6 Ak47 pack"
              					<div class="comment_answer_button"><a href="javascript://" rel="nofollow" onclick="new _uWnd('AddC','Добавить комментарий',-550,-100,{autosize:1,closeonesc:1,resize:0},{url:'/index/58-3011'});return false;">Ответить</a></div>
              				</div>
              			</div>
              		</div>
              	</div>




<?php

echo $date;

  $page_id = $news_id;// Уникальный идентификатор страницы (статьи или поста)

  $comments = R::getAll( "SELECT * FROM `comments` WHERE `page_id`='$page_id'" );
  foreach ($comments as $comment) { ?>
    <div class="comment">
    <div class="comment_top"><b><?php echo $comment['name'] ?></b> <span class="comm_time"><?php echo str_replace('-','.',$comment['date']) ?></span></div>
    <div class="comment_message_in"><?php echo $comment['message'] ?>
    </div>
    </div>
  <?php } ?>

</div>

</main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/sidebar.php'; ?>

  </div>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php'; ?>

  <?php require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/auth.php'; ?>

</body>

</html>
