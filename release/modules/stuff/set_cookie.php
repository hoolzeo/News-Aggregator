<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';

// Получаем выделенные чекбоксы и сохраняем в куки
if (isset($_POST['NightCheckBox'])) {
  Setcookie("NightCheckBox", $_POST['NightCheckBox']);
}


?>
