<?php
require_once("pdo_connect.php");
//if (!isset($_POST["name"])) {
//    echo "沒有資料喔";
//    exit();
//}
$id = $_POST["id"];
$pet_id = $_POST["pet_id"];
$pre_time = $_POST["pre_time"];
$address = $_POST["address"];
$price = $_POST["price"];
$buyer_id = $_POST["buyer_id"];
$seller_id = $_POST["seller_id"];
$status = $_POST["status"];
$created_time = $_POST["created_time"];


try {
    $sql = "UPDATE db_order SET pet_id=?, pre_time=?, address=? ,price=?, buyer_id=? ,seller_id=? ,status=? ,created_time=? WHERE id=?";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$pet_id, $pre_time, $address, $price, $buyer_id, $seller_id, $status, $created_time, $id]);
    $id = $db_host->lastInsertId();
    echo "修改成功<br>";

} catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}
$db_host = NULL;
header("location: list-order.php");