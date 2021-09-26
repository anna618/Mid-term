<?php
require_once("pdo_connect.php");
//if(!isset($_POST["name"])){
//    echo "沒有資料喔";
//    exit();
//}

$pet_id = $_POST["pet_id"];
$pre_time = $_POST["pre_time"]." ".$_POST["pre_time_1"];
$address = $_POST["address"];
$price = $_POST["price"];
$buyer_id = $_POST["buyer_id"];
$seller_id = $_POST["seller_id"];
$status = $_POST["status"];
$created_time = date('y-m-d H:i:s');
//var_dump($pre_time);
try {
    $sql = "INSERT INTO db_order(pet_id, pre_time, address, price, buyer_id, seller_id,status,created_time)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$pet_id, $pre_time, $address, $price, $buyer_id, $seller_id, $status, $created_time]);
    $id = $db_host->lastInsertId(); //取得最新一筆資料的 id
    echo "寫入成功<br>";
} catch (PDOException $e) {
    echo "寫入失敗<br>";
    echo "Error" . $e->getMessage();
    exit;
}
$db_host = NULL;
header("location: list-order.php");