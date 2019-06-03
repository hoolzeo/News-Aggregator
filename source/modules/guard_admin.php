<?php
$username = $_SESSION['logged_user']->login;

$isAdmin = R::findOne('users', 'login = ?', [$username])['is_admin'];

if (!$isAdmin) {
  header('Location: /');
}
?>
