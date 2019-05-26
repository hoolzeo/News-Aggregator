<?php
    $msg_box = ""; // в этой переменной будем хранить сообщения формы
     
    if($_POST['btn_submit']){
		
        $errors = array(); // контейнер для ошибок
        // проверяем корректность полей
        if($_POST['user_name'] == "")    $errors[] = "Поле 'Ваше имя' не заполнено!";
        if($_POST['user_email'] == "")   $errors[] = "Поле 'Ваш e-mail' не заполнено!";
        if($_POST['text_comment'] == "") $errors[] = "Поле 'Текст сообщения' не заполнено!";
 
        // если форма без ошибок
        if(empty($errors)){    
				mail('nexus.nm@yandex.ru', 'Subject', 'Сообщение: '.$_POST['text_comment'].' от '.$_POST['user_name'].' ('.$_POST['user_email'] .')');


            $msg_box = "<span style='color: green;'>Сообщение успешно отправлено!</span>";
        }else{
            // если были ошибки, то выводим их
            $msg_box = "";
            foreach($errors as $one_error){
                $msg_box .= "<span style='color: red;'>$one_error</span><br/>";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Обратная связь</title>

  <?php require "modules/meta.php"; ?>
</head>
<body>

  <?php require "modules/header.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <div class="wrapper container">
    <main>
	      <h1>Обратная связь</h1>


    <?= $msg_box; // вывод сообщений ?>

    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" name="frm_feedback">
        <label>Ваше имя:</label><br/>
        <input type="text" name="user_name" value="<?=($_POST['user_name']) ? $_POST['user_name'] : ""; // сохраняем то, что вводили?>" /><br/>
         
        <label>Ваш e-mail:</label><br/>
        <input type="text" name="user_email" value="<?=($_POST['user_email']) ? $_POST['user_email'] : ""; // сохраняем то, что вводили?>" /><br/>
         
        <label>Текст сообщения:</label><br/>
        <textarea name="text_comment"><?=($_POST['text_comment']) ? $_POST['text_comment'] : ""; // сохраняем то, что вводили?></textarea>
         
        <br/>
        <input type="submit" value="Отправить" name="btn_submit" />
    </form>

    </main>

    <?php require "modules/sidebar.php"; ?>

  </div>

  <?php require "modules/footer.php"; ?>

  <?php require "modules/stuff/auth.php"; ?>

</body>

</html>
