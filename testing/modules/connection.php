<?php
$user = 'ken';
$password = 'kenjoi1';
$db = 'kennethzhangnet';
$host = 'localhost';
$port = 8889;

$connection = mysqli_connect($host, $user, $password, $db, $port);
if (!$connection) {
    die('mysqli_init failed');
}

if (!$connection) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
?>