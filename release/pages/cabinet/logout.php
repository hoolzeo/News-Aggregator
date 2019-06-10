<?php
	require $_SERVER['DOCUMENT_ROOT'].'/modules/require_libs.php';
	unset($_SESSION['logged_user']);
	header('Location: /');
?>
