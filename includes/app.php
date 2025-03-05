<?php

$database_info = include __DIR__ . '/../config/database.php';

$connect = mysqli_connect(
    $database_info['servername'],
    $database_info['username'],
    $database_info['password'],
    $database_info['dbname'],
    $database_info['port']
);
$query = "";

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

 include __DIR__."/helper.php";

