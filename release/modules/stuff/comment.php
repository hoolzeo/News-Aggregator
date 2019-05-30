<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/libs/RedBeanPHP/db.php';

  /* Принимаем данные из формы */
  $name = $_POST["name"];
  $page_id = $_POST["page_id"];
  $message = $_POST["message"];

  $name = htmlspecialchars($name);// Преобразуем спецсимволы в HTML-сущности
  $message = htmlspecialchars($message);// Преобразуем спецсимволы в HTML-сущности

  $sql_comments = R::dispense('comments');
  if (!empty($name)) $sql_comments->name = $name;
  if (!empty($page_id)) $sql_comments->page_id = $page_id;
  if (!empty($message)) $sql_comments->message = $message;
  $sql_comments->date = date("d-m-Y в H:i:s");

  R::store($sql_comments);

  header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно

?>
