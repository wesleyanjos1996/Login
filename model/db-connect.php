<?php
$nameServer = 'localhost';
$userName = 'root';
$password = 'devOPS26WDA@';
$databaseName = 'sistemaloginphp';
$connect = mysqli_connect($nameServer, $userName, $password, $databaseName);
if (mysqli_connect_error()) echo 'Falha na conexão: '.mysqli_connect_error();
?>