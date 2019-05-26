<?php
	require $_SERVER['DOCUMENT_ROOT'].'/modules/libs/RedBeanPHP/db.php';
	unset($_SESSION['logged_user']);
	header('Location: /');
?>
