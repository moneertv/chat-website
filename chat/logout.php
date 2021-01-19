<?php
session_start();
include 'connect.php';
$stmt = $con-> prepare("UPDATE `users` SET `whoOn` = 'offline' WHERE `users`.`id` = ?;");
$stmt->execute(array($_SESSION['id']));
session_unset();
session_destroy();
header('location:index.php');
exit();