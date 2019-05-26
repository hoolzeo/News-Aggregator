<?php
//require '/modules/libs/RedBeanPHP/rb.php';

require "rb.php";
R::setup( 'mysql:host=194.67.197.14;dbname=newz','user', 'user' );

if ( !R::testconnection() )
{
        exit ('Нет соединения с базой данных');
}

session_start();
?>
