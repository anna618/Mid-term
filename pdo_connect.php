<?php
session_start();

$servername = "localhost";
$username = "anna";
$password = "12345";
$dbname = "independent_study_04";

try {
    $db_host = new PDO(
        "mysql:host={$servername};dbname={$dbname};charset=utf8",
        $username, $password);
    //    echo "資料庫連線成功<br>";
} catch (PDOException $e) {
    echo "資料庫連線失敗<br>";
    echo "Error:" . $e->getMessage();
    exit;
}