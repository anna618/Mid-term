<?php
require_once("pdo_connect.php");

$id=$_GET["id"]; // 抓要編輯的那個id
$deleted_time = date('Y-m-d H:i:s'); // 建立刪除的時間

try {
    $sql="UPDATE db_user SET deleted_time =? WHERE id=?";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$deleted_time, $id]);
    echo "修改成功<br>";

}catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}
$db_host = NULL;
header("location: list-user.php");