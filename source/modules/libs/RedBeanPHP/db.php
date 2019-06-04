<?php
require "rb.php";
R::setup( 'mysql:host='.$db_host.';dbname='.$db_name, $db_login, $db_password);

if ( !R::testconnection() )
{
        exit ('Нет соединения с базой данных');
}

session_start();
?>
