<?php
$host = 'localhost';
$database = 'MyBD';
$user = 'Alex';
$password = '1798235479';

$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

mysqli_select_db($link, $database) or die ("Íåò ñîåäèíåíèÿ ñ ÁÄ ".mysqli_error());
